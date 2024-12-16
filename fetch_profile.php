<?php
header('Content-Type: application/json');

// Fetch user profile
try {
    $dsn = "mysql:host=localhost;dbname=user_management";
    $username = "Jin Kai";
    $password = "1234546";
    $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
    //Use PDO to detect the exception
    $pdo = new PDO($dsn, $username, $password, $options);

    $sql = "SELECT * FROM user_profile WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => 1]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        echo json_encode($result);
    } else {
        echo json_encode(['error' => 'No profile found']);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}

?>

