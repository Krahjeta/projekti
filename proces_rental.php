<?php 
session_start();

if (!isset($_SESSION['id'])) {
    echo "Unauthorized access. Please log in first.";
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "car_rental";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (empty($_POST['start_date']) || empty($_POST['end_date']) || empty($_POST['car_id'])) {
    echo "All fields are required.";
    var_dump($_POST);
    exit;
}

$car_id = $_POST['car_id'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];

// Validate if the car_id exists
$sql = "SELECT id FROM cars WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $car_id);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 0) {
    echo "The car you're trying to rent does not exist.";
    exit;
}

$stmt->close();

// Check if the car is already rented during the selected period
$sql = "SELECT id FROM rentals WHERE car_id = ? AND (
    (start_date BETWEEN ? AND ?) OR
    (end_date BETWEEN ? AND ?) OR
    (? BETWEEN start_date AND end_date)
)";

$stmt = $conn->prepare($sql);

// Bind the parameters (note that start_date and end_date are passed twice in the query)
$stmt->bind_param("isssss", $car_id, $start_date, $end_date, $start_date, $end_date, $start_date);
$stmt->execute();
$stmt->store_result();



if ($stmt->num_rows > 0) {
    echo "The car is already rented during this period.";
    exit;
}

$stmt->close();

$user_id = $_SESSION['id']; // Use the session's user ID

// Insert rental into the database
$sql = "INSERT INTO rentals (car_id, user_id, start_date, end_date) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iiss", $car_id, $user_id, $start_date, $end_date);

if ($stmt->execute()) {
    echo "Car rented successfully from $start_date to $end_date!";
} else {
    echo "Error: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
