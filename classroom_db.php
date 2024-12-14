<?php
$servername = "localhost";
$username = "DanishLam";
$password = "Dsl140904";
$database = "classroom_db";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
