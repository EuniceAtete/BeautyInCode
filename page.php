<?php
include '../conn.php';
session_start();

// Fetch all users
$result = $conn->query("SELECT * FROM users");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body { background:#111; color:#fff; font-family:Arial; text-align:center; }
        table { margin:auto; width:80%; border-collapse:collapse; }
        th, td { padding:10px; border:1px solid #444; }
        a { color:cyan; margin:0 5px; }
    </style>
</head>
<body>

<h1>Dashboard</h1>
<p>Welcome, <?php echo $_SESSION['user']; ?></p>

<a href="create.php">+ Add User</a>
<a href="logout.php">Logout</a>

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
        <td><?= $row['id'] ?></td>
        <td><?= $row['username'] ?></td>
        <td><?= $row['email'] ?></td>
        <td><?= $row['age'] ?></td>
        <td><?= $row['gender'] ?></td>
        <td>
            <a href="edit.php?id=<?= $row['id'] ?>">Edit</a>
            <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete user?')">Delete</a>
        </td>
    </tr>
    <?php } ?>

</table>

</body>
</html>