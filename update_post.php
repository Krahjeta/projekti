<?php
session_start();

// Ensure the user is logged in (redirect if not)
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the updated car details from the form
    $car_id = $_POST['id'];
    $name = $_POST['name'];
    $year = $_POST['year'];
    $price = $_POST['price'];
    $monthly_price = $_POST['monthly_price'];
    $image = $_POST['image'];

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = ""; // Replace with your password
    $dbname = "car_rental";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the update query
    $sql = "UPDATE cars SET name = ?, year = ?, price = ?, monthly_price = ?, image = ? WHERE id = ?";

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error preparing the query: " . $conn->error);
    }

    // Bind parameters and execute the query
    $stmt->bind_param("sssssi", $name, $year, $price, $monthly_price, $image, $car_id);

    // Check if the update was successful
    if ($stmt->execute()) {
        // Redirect to the user_edit_post page or another page to confirm the update
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
