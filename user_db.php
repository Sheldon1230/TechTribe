<?php
$servername = "localhost";
$username = "DanishLam"; // Replace with your database username
$password = "Dsl140904"; // Replace with your database password
$dbname = "user_management";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
