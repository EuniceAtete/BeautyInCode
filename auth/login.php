<?php
include 'conn.php';
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        $user = $result->fetch_assoc();
        if(password_verify($password,$user['password'])){
            $_SESSION['user'] = $user['username'];
            header("Location: home.php");
        } else {
            echo "Invalid username or password.";
        }

    } else {
    echo "Invalid username or password";
    }
}

?>
