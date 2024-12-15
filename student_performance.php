<?php
$servername = "localhost";
$username = "DanishLam"; // Update with your MySQL username
$password = "Dsl140904"; // Update with your MySQL password
$dbname = "student_performance";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch performance data for all students and tasks
$sql = "SELECT s.name, t.task_name, t.completion_rate, t.time_spent, t.core_concept_understanding
        FROM task_performance t
        JOIN students s ON t.student_id = s.id";

$result = $conn->query($sql);

$performance_data = [];
$completion_rates = [];
$time_spent = [];
$core_concepts = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $performance_data[] = $row;
        // Collecting individual metrics for averages
        $completion_rates[] = $row['completion_rate'];
        $time_spent[] = $row['time_spent'];
        $core_concepts[] = $row['core_concept_understanding'];
    }
} else {
    // If no data found, send an error message
    echo json_encode(["status" => "error", "message" => "No data found"]);
    exit;
}

// Calculating averages for the completion rate, time spent, and core concept understanding
$avg_completion_rate = array_sum($completion_rates) / count($completion_rates);
$avg_time_spent = array_sum($time_spent) / count($time_spent);
$avg_core_concepts = array_sum($core_concepts) / count($core_concepts);

// Close connection
$conn->close();

// Return performance data and calculated averages as JSON
echo json_encode([
    'status' => 'success',
    'data' => $performance_data,
    'average_completion_rate' => round($avg_completion_rate, 2), // Rounded to 2 decimal places
    'average_time_spent' => round($avg_time_spent, 2), // Rounded to 2 decimal places
    'average_core_concepts' => round($avg_core_concepts, 2) // Rounded to 2 decimal places
]);
?>
