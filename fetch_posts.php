<?php
$servername = "localhost";
$username = "root";
$password = ""; // Replace with your password
$dbname = "car_rental";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch posts from database
$sql = "SELECT * FROM cars";
$result = $conn->query($sql);

echo '<div class="services-container">';
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="box">
                <div class="box-img">
                    <img src="' . $row['image'] . '" alt="">
                </div>
                <p>' . $row['year'] . '</p>
                <h3>' . $row['name'] . '</h3>
                <h2>$' . $row['price'] . ' | $' . $row['monthly_price'] . ' <span>/month</span></h2>
                <a href="#" class="btn">Rent Now</a>
              </div>';
    }
} else {
    echo '<p>No cars available.</p>';
}
echo '</div>';

$conn->close();
?>
