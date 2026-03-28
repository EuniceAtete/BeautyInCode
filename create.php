<?php
include '../conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $conn->query("INSERT INTO users(username,email,age,gender,password)
    VALUES('$username','$email','$age','$gender','$password')");

    header("Location: home.php");
}
?>

<form method="POST">
    <input name="username" placeholder="Username"><br>
    <input name="email" placeholder="Email"><br>
    <input name="age" type="number" placeholder="Age"><br>

    <select name="gender">
        <option>male</option>
        <option>female</option>
    </select><br>

    <input name="password" type="password" placeholder="Password"><br>

    <button>Add User</button>
</form>