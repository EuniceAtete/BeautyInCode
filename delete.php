<?php
include '../conn.php';

$id = $_GET['id'];

$conn->query("DELETE FROM users WHERE id=$id");

header("Location: home.php");
?>