<?php
include '../conn.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM users WHERE id=$id");
$user = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $email = $_POST['email'];

    $conn->query("UPDATE users SET username='$username', email='$email' WHERE id=$id");

    header("Location: home.php");
}
?>

<form method="POST">
    <input name="username" value="<?= $user['username'] ?>"><br>
    <input name="email" value="<?= $user['email'] ?>"><br>

    <button>Update</button>
</form>