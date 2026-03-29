<?php
include 'conn.php';
session_start();

$result = $conn->query("SELECT id, username, email, age, gender FROM users ORDER BY id DESC");
$currentUser = $_SESSION['user'] ?? 'Dashboard user';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body { background:#111; color:#fff; font-family:Arial, sans-serif; text-align:center; margin:0; padding:40px 20px; }
        table { margin:24px auto; width:min(100%, 950px); border-collapse:collapse; }
        th, td { padding:12px; border:1px solid #444; }
        th { background:#1f1f1f; }
        a { color:cyan; margin:0 5px; font-weight:bold; text-decoration:none; }
        a:hover { text-decoration:underline; }
        .actions { margin-top:18px; }
    </style>
</head>
<body>

<h1>Dashboard</h1>
<p>Welcome, <?php echo htmlspecialchars($currentUser); ?></p>

<div class="actions">
    <a href="create.php">+ Add User</a>
    <a href="logout.php">Logout</a>
</div>

<table>
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Email</th>
        <th>Age</th>
        <th>Gender</th>
        <th>Actions</th>
    </tr>

    <?php while($row = $result->fetch_assoc()) { ?>
    <tr>
        <td><?= htmlspecialchars($row['id']) ?></td>
        <td><?= htmlspecialchars($row['username']) ?></td>
        <td><?= htmlspecialchars($row['email']) ?></td>
        <td><?= htmlspecialchars($row['age']) ?></td>
        <td><?= htmlspecialchars($row['gender']) ?></td>
        <td>
            <a href="edit.php?id=<?= urlencode($row['id']) ?>">Edit</a>
            <a href="delete.php?id=<?= urlencode($row['id']) ?>" onclick="return confirm('Delete user?')">Delete</a>
        </td>
    </tr>
    <?php } ?>

</table>

</body>
</html>
