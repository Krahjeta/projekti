<?php
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "car_rental";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM cars";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="slide box">
                <div class="box-img">
                    <img src="' . htmlspecialchars($row['image']) . '" alt="Car Image">
                </div>
                <p>' . htmlspecialchars($row['year']) . '</p>
                <h3>' . htmlspecialchars($row['name']) . '</h3>
                <h2>$' . number_format($row['price'], 2) . ' | $' . number_format($row['monthly_price'], 2) . ' <span>/month</span></h2>

                <a href="#" class="btn" data-car-id="' . $row['id'] . '">Rent Now</a>
              </div>';
    }
} else {
    echo '<p>No cars available.</p>';
}

$conn->close();
?>
