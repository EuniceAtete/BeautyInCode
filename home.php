<?php
include 'conn.php';
session_start();

if(!isset($_SESSION['user'])){
    header('Location: login.html');
    exit();
}
$username = $_SESSION['user'];

$sql= "SELECT * FROM users WHERE username = '$username'";
$result = $conn->query($sql);
if($result->num_rows > 0){
    $user = $result->fetch_assoc();
} else {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <style>
        body {
            background-color: #111;
            color: #fff;
            font-family: Arial, sans-serif;
            text-align: center;
            padding-top: 100px;
        }
        a {
            color: #0ff;
            text-decoration: none;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($user['username']); ?>!</h1>
    <p>You have successfully logged in.</p>
    <p><a href="page.php">Open Dashboard</a></p>
    <p><a href="logout.php">Logout</a></p>
</body>
</html>
