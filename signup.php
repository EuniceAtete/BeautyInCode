<?php
include "conn.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $username = $_POST['username'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users(username, email, age, gender, password)
            VALUES('$username', '$email', '$age', '$gender', '$password')";

    if ($conn->query($sql) === TRUE) {
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