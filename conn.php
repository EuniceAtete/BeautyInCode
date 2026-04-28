<?php
$host = "localhost";
$user = "root";
$password = "G7f$9kL!2bQx@Z1m@";
$db   = "users_db";

$conn = new mysqli($host, $user, $password, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>