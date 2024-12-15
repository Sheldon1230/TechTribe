<?php
session_start();
include('user_db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = md5($_POST['password']); // Encrypt password with MD5

    // Fetch user from the database
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id']; // Save user ID in session
        header("Location: teacher.php");
    } else {
        echo "Invalid email or password.";
    }
}
?>
