<?php
include 'conn.php';
session_start();

$id = (int) $_GET['id'];

$stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: page.php");
exit();
?>
