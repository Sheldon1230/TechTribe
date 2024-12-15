<?php
// Database connection
$servername = "localhost";
$username = "DanishLam";
$password = "Dsl140904";
$database = "admindata";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get POST data
$metric = $_POST['metric'] ?? null;
$action = $_POST['action'] ?? null;
$month = $_POST['month'] ?? null;
$count = floatval($_POST['count'] ?? 0);

// Allowed metrics
$allowedMetrics = ['Students', 'Teachers', 'Employees', 'Earnings'];

// Validate inputs
if (in_array($metric, $allowedMetrics) && in_array($action, ['add', 'delete']) && $count > 0) {
    if ($metric === 'Earnings' && $month) {
        // Fetch current earnings for the month
        $checkQuery = "SELECT earnings FROM earnings WHERE month = ?";
        $checkStmt = $conn->prepare($checkQuery);
        $checkStmt->bind_param("s", $month);
        $checkStmt->execute();
        $result = $checkStmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $currentEarnings = floatval($row['earnings']);

            // Handle add or delete action
            if ($action === 'delete') {
                $newEarnings = max(0, $currentEarnings - $count); // Prevent negative values
            } elseif ($action === 'add') {
                $newEarnings = $currentEarnings + $count;
            } else {
                echo json_encode(["status" => "error", "message" => "Invalid action"]);
                exit;
            }

            // Update or delete earnings row
            if ($newEarnings == 0 && $action === 'delete') {
                // Delete the row if earnings become zero
                $deleteQuery = "DELETE FROM earnings WHERE month = ?";
                $deleteStmt = $conn->prepare($deleteQuery);
                $deleteStmt->bind_param("s", $month);
                $deleteStmt->execute();
            } else {
                // Update earnings value
                $updateQuery = "UPDATE earnings SET earnings = ? WHERE month = ?";
                $updateStmt = $conn->prepare($updateQuery);
                $updateStmt->bind_param("ds", $newEarnings, $month);
                $updateStmt->execute();
            }

            // Update the total earnings in the dashboard_counts table
            if ($action === 'delete') {
                $deductQuery = "UPDATE dashboard_counts SET count = count - ? WHERE metric = 'Earnings'";
                $deductStmt = $conn->prepare($deductQuery);
                $deductStmt->bind_param("d", $count);
                $deductStmt->execute();
            } elseif ($action === 'add') {
                $addQuery = "UPDATE dashboard_counts SET count = count + ? WHERE metric = 'Earnings'";
                $addStmt = $conn->prepare($addQuery);
                $addStmt->bind_param("d", $count);
                $addStmt->execute();
            }

            // Ensure the earnings count is not negative
            $fixNegativeQuery = "UPDATE dashboard_counts SET count = GREATEST(count, 0) WHERE metric = 'Earnings'";
            $conn->query($fixNegativeQuery);

            // Fetch the updated total earnings
            $sumQuery = "SELECT count AS totalEarnings FROM dashboard_counts WHERE metric = 'Earnings'";
            $sumResult = $conn->query($sumQuery);
            $totalEarnings = $sumResult->fetch_assoc()['totalEarnings'];

            echo json_encode(["status" => "success", "newCount" => $totalEarnings]);
        } else {
            echo json_encode(["status" => "error", "message" => "Month not found"]);
        }
    } else {
        // Handle Students, Teachers, and Employees
        $fetchQuery = "SELECT count FROM dashboard_counts WHERE metric = ?";
        $fetchStmt = $conn->prepare($fetchQuery);
        $fetchStmt->bind_param("s", $metric);
        $fetchStmt->execute();
        $result = $fetchStmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $currentCount = floatval($row['count']);
            $newCount = ($action === 'add') ? $currentCount + $count : max(0, $currentCount - $count);

            // Update the count in the database
            $updateQuery = "UPDATE dashboard_counts SET count = ? WHERE metric = ?";
            $updateStmt = $conn->prepare($updateQuery);
            $updateStmt->bind_param("ds", $newCount, $metric);

            if ($updateStmt->execute()) {
                echo json_encode(["status" => "success", "newCount" => $newCount]);
            } else {
                echo json_encode(["status" => "error", "message" => "Failed to update count"]);
            }
        } else {
            echo json_encode(["status" => "error", "message" => "Metric not found"]);
        }
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid input"]);
}

$conn->close();
?>
