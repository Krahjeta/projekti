<?php
require_once 'classes/Database.php';
require_once 'classes/User.php';

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
?>