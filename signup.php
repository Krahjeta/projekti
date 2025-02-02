<?php
session_start();
require_once 'Database.php';
require_once 'User.php';

header('Content-Type: application/json'); 

ini_set('display_errors', 1);
error_reporting(E_ALL);

$database = new Database();
$db = $database->connect();
$user = new User($db);

$response = [];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $role = $_POST['role'];

    if ($password !== $cpassword) {
        $response['status'] = 'error';
        $response['message'] = 'Passwords do not match';
    } else {
  
        try {
            $registrationResponse = $user->register($username, $email, $password, $role);

            $response = $registrationResponse;
        } catch (Exception $e) {
            
            $response['status'] = 'error';
            $response['message'] = 'An error occurred: ' . $e->getMessage();
        }
    }

    echo json_encode($response);
    exit;

} else {
    
    $response['status'] = 'error';
    $response['message'] = 'Invalid request method';
    echo json_encode($response);
    exit;
}
