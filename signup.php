<?php
session_start();  // Always call session_start() at the top


require_once 'Database.php';
require_once 'User.php';

$database = new Database();
$db = $database->connect();

$user = new User($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($user->register($username, $email, $password)) {
        echo "Sign-up successful!";
    } else {
        echo "Sign-up failed.";
    }
}
print_r($_POST); 
?>