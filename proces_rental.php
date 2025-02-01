<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    die("Unauthorized access.");
}

require "db_connection.php"; // Include your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION["user_id"];
    $car_id = $_POST["car_id"];
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];

    $query = "INSERT INTO rentals (user_id, car_id, start_date, end_date) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iiss", $user_id, $car_id, $start_date, $end_date);

    if ($stmt->execute()) {
        echo "Rental confirmed!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
