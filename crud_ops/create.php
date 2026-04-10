<?php
include 'conn.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $age = (int) $_POST['age'];
    $gender = $_POST['gender'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users(username, email, age, gender, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiss", $username, $email, $age, $gender, $password);
    $stmt->execute();

    header("Location: page.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <style>
        body { background:#111; color:#fff; font-family:Arial, sans-serif; text-align:center; padding:40px 20px; }
        form { display:grid; gap:12px; width:min(100%, 360px); margin:24px auto; }
        input, select, button { padding:12px; border:1px solid #555; background:#1f1f1f; color:#fff; border-radius:4px; }
        button { cursor:pointer; font-weight:bold; }
        a { color:cyan; }
    </style>
</head>
<body>
<h1>Add User</h1>

<form method="POST">
    <input name="username" placeholder="Username" required>
    <input name="email" type="email" placeholder="Email" required>
    <input name="age" type="number" placeholder="Age" min="1" required>
    <select name="gender">
        <option value="male">Male</option>
        <option value="female">Female</option>
    </select>
    <input name="password" type="password" placeholder="Password" required>
    <button>Add User</button>
</form>

<a href="page.php">Back to dashboard</a>
</body>
</html>
