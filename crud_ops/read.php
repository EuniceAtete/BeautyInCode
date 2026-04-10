<?php
require_once __DIR__ . '/../config/conn.php';
session_start();

$stmt = $conn->prepare("SELECT id, username, email, age, gender FROM users ORDER BY id ASC");
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <style>
        body { background:#111; color:#fff; font-family:Arial, sans-serif; text-align:center; margin:0; padding:40px 20px; }
        table { margin:24px auto; width:min(100%, 950px); border-collapse:collapse; }
        th, td { padding:12px; border:1px solid #444; }
        th { background:#1f1f1f; }
        a { color:cyan; margin:0 5px; font-weight:bold; text-decoration:none; }
        a:hover { text-decoration:underline; }
        .actions { margin-top:18px; }
        .empty { color:#bbb; padding:24px; }
    </style>
</head>
<body>
    <h1>Users</h1>

    <div class="actions">
        <a href="create.php">+ Add User</a>
        <a href="../home_dashboard/home.php">Home</a>
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

        <?php if ($result->num_rows > 0) { ?>
            <?php while ($row = $result->fetch_assoc()) { ?>
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
        <?php } else { ?>
            <tr>
                <td class="empty" colspan="6">No users found.</td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
