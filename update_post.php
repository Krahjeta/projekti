<?php
session_start();


if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $car_id = $_POST['id'];
    $name = $_POST['name'];
    $year = $_POST['year'];
    $price = $_POST['price'];
    $monthly_price = $_POST['monthly_price'];
    $image = $_POST['image'];


    $servername = "localhost";
    $username = "root";
    $password = ""; 
    $dbname = "car_rental";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE cars SET name = ?, year = ?, price = ?, monthly_price = ?, image = ? WHERE id = ?";

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error preparing the query: " . $conn->error);
    }


    $stmt->bind_param("sssssi", $name, $year, $price, $monthly_price, $image, $car_id);


    if ($stmt->execute()) {
        
        header('Location: user_edit_post.php');
        exit;
    } else {
        echo "Error updating car details: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
    exit;
}
