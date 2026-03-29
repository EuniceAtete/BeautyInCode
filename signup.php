<?php
include "conn.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $age = (int) $_POST['age'];
    $gender = $_POST['gender'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users(username, email, age, gender, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiss", $username, $email, $age, $gender, $password);

    if ($stmt->execute()) {
        echo "<style>
        *{
        background-color:#000;
        color:#fff;
        font-size:20px;
        font-weight:bold;
        }
        </style>";
    echo "<h3>Signup successful!</h3>";
    echo "<a href='login.html'>Go back</a>";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
