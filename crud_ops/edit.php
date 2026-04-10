<?php
include 'conn.php';
session_start();

$id = (int) $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $age = (int) $_POST['age'];
    $gender = $_POST['gender'];

    $stmt = $conn->prepare("UPDATE users SET username = ?, email = ?, age = ?, gender = ? WHERE id = ?");
    $stmt->bind_param("ssisi", $username, $email, $age, $gender, $id);
    $stmt->execute();

    header("Location: page.php");
    exit();
}

$stmt = $conn->prepare("SELECT id, username, email, age, gender FROM users WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    header("Location: page.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <style>
        body { background:#111; color:#fff; font-family:Arial, sans-serif; text-align:center; padding:40px 20px; }
        form { display:grid; gap:12px; width:min(100%, 360px); margin:24px auto; }
        input, select, button { padding:12px; border:1px solid #555; background:#1f1f1f; color:#fff; border-radius:4px; }
        button { cursor:pointer; font-weight:bold; }
        a { color:cyan; }
    </style>
</head>
<body>
<h1>Edit User</h1>

<form method="POST">
    <input name="username" value="<?= htmlspecialchars($user['username']) ?>" required>
    <input name="email" type="email" value="<?= htmlspecialchars($user['email']) ?>" required>
    <input name="age" type="number" min="1" value="<?= htmlspecialchars($user['age']) ?>" required>
    <select name="gender">
        <option value="male" <?= $user['gender'] === 'male' ? 'selected' : '' ?>>Male</option>
        <option value="female" <?= $user['gender'] === 'female' ? 'selected' : '' ?>>Female</option>
    </select>
    <button>Update</button>
</form>

<a href="page.php">Back to dashboard</a>
</body>
</html>
