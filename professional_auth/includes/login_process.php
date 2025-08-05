<?php
session_start();

include_once 'db.php';

header('Content-Type: application/json');

$response = ['success' => false, 'message' => 'Invalid request'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, fName, lName, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['fName'] . ' ' . $user['lName'];
            $response['success'] = true;
        } else {
            $response['message'] = 'Incorrect password.';
        }
    } else {
        $response['message'] = 'No user found with that email.';
    }
    $stmt->close();
    $conn->close();
} 

echo json_encode($response);
?>