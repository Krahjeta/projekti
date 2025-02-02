<?php
session_start();

$response = ["logged_in" => false];

if (isset($_SESSION["id"])) {
    $response["logged_in"] = true;
}

echo json_encode($response);
?>
