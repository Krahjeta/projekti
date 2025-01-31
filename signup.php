<?php
<<<<<<< HEAD
=======
session_start();  // Always call session_start() at the top


>>>>>>> e413c0804a2048428013e78675ac7e653ae94c67
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