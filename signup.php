<?php
session_start();
require_once 'Database.php';
require_once 'User.php';

$database = new Database();
$db = $database->connect();
$user = new User($db);

$response = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $user_type = $_POST['user_type'];

    if ($password !== $cpassword) {
        $response['status'] = 'error';
        $response['message'] = 'Passwords do not match';
    } else {
        if ($user->register($username, $email, $password, $user_type)) {
            $response['status'] = 'success';
            $response['message'] = 'Sign-up successful!';
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Sign-up failed. User might already exist.';
        }
    }

    echo json_encode($response);
    exit;
}
