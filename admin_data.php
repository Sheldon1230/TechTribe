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

// Fetch earnings for line chart
$earnings = [];
$result = $conn->query("SELECT month, earnings FROM earnings");
while ($row = $result->fetch_assoc()) {
    $earnings[] = $row;
}

// Fetch employee categories for doughnut chart
$employees = [];
$result = $conn->query("SELECT category, count FROM employee_categories");
while ($row = $result->fetch_assoc()) {
    $employees[] = $row;
}

// Fetch dashboard counts
$dashboardCounts = [];
$result = $conn->query("SELECT metric, count FROM dashboard_counts");
while ($row = $result->fetch_assoc()) {
    $dashboardCounts[] = $row;
}

// Output JSON
header('Content-Type: application/json');
echo json_encode([
    "earnings" => $earnings,
    "employees" => $employees,
    "dashboardCounts" => $dashboardCounts
]);

$conn->close();
?>
