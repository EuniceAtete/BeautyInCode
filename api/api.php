<?php

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");


$host = 'localhost';
$db = 'api_test';
$user = 'root';
$pass = 'G7f$9kL!2bQx@Z1m@';

$conn = new mysqli($host, $user, $pass, $db);

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {

    case 'GET':

        if (isset($_GET['id'])) {

            $id = $_GET['id'];

            $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();

            $result = $stmt->get_result();

            $user = $result->fetch_assoc();

            echo json_encode($user);

        } else {

            $result = $conn->query("
                SELECT * FROM users
            ");

            $users = [];

            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }

            echo json_encode($users);
        }

        break;

    case 'POST':

        $data = json_decode(
            file_get_contents("php://input"),
            true
        );

        $name = $conn->real_escape_string($data['name']);
        $email = $conn->real_escape_string($data['email']);

        $conn->query("
            INSERT INTO users (name, email)
            VALUES ('$name', '$email')
        ");

        echo json_encode([
            "message" => "User created"
        ]);

        break;

    case 'PUT':

    $data = json_decode(
        file_get_contents("php://input"),
        true
    );

    if (!isset($data['id'])) {

        echo json_encode([
            "error" => "ID is required"
        ]);

        break;
    }

    $id = (int)$data['id'];

    $name = $conn->real_escape_string($data['name']);
    $email = $conn->real_escape_string($data['email']);

    $sql = "
        UPDATE users
        SET name = '$name',
            email = '$email'
        WHERE id = $id
    ";

    if ($conn->query($sql)) {

        echo json_encode([
            "message" => "User updated"
        ]);

    } else {

        echo json_encode([
            "error" => $conn->error
        ]);
    }

    break;

    case 'DELETE':

        $id = $_GET['id'] ?? null;

if ($id === null) {
    echo json_encode([
        "message" => "Missing user id"
    ]);
    exit;
}

$id = (int) $id;

$conn->query("
    DELETE FROM users
    WHERE id = $id
");

echo json_encode([
    "message" => "User deleted"
]);

break;

    default:

        echo json_encode([
            "error" => "Invalid request method"
        ]);

        break;
}

$conn->close();

?>