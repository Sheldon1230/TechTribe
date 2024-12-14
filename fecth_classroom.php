<?php
include('classroom_db.php');
header('Content-Type: application/json'); // Ensure this is at the top

var_dump($_POST); // Debugging line

if (isset($_POST['classroom'])) {
    $classroom_name = $_POST['classroom'];

    // Fetch content for the selected classroom
    $stmt = $conn->prepare("SELECT content FROM classrooms WHERE classroom_name = ?");
    $stmt->bind_param("s", $classroom_name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode(['status' => 'success', 'content' => $row['content']]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Classroom not found']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'No classroom selected']);
}
?>
