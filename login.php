<?php
include 'conn.php';
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username= '$username'";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        $user = $result->fetch_assoc();
        if(password_verify($password,$user['password'])){
            $_SESSION['user'] = $user['username'];
            header("Location: home.php");
        } else {
            echo "Invalid email or password.";
        }

    } else {
    echo "Invalid email or password";
    }
}

?>