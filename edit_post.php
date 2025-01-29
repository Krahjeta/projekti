<?php
session_start();

// Ensure the user is logged in (redirect if not)
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if (isset($_GET['id'])) {
    $car_id = $_GET['id'];
    
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = ""; // Replace with your password
    $dbname = "car_rental";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get car details
    $sql = "SELECT * FROM cars WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $car_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $car = $result->fetch_assoc();
    } else {
        echo "Car not found.";
        exit;
    }

    $conn->close();
} else {
    echo "No car ID provided.";
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Car</title>
</head>
<body>
<header>
    <a href="Website.php" class="logo"><img src="logo.png" alt="logo"></a>

    <div class="bx bx-menu" id="menu-icon"></div>

    <ul class="navbar">
        <li><a href="Website.php">Home</a></li>
        <li><a href="ride.php">Ride</a></li>
        <li><a href="service.php">Services</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="reviews.php">Reviews</a></li>
    </ul>

    <div class="header-btn">
        <?php
        if (isset($_SESSION['id'])) {
            // User is logged in, show logout and dashboard options
            echo '<li><a href="logout.php">Logout</a></li>';
            echo '<li><a href="dashboard.php">Dashboard</a></li>';
        } else {
            // User is not logged in, show sign up and sign in options
            echo '<a href="#" class="sign-up">Sign Up</a>';
            echo '<a href="#" class="sign-in">Sign In</a>';
        }
        ?>
    </div>

    <li class="nav-profil">
        <div class="avatar">
            <img src="rev1.jpg" alt="User Avatar">
        </div>
        <ul>
            <?php
            if (isset($_SESSION['id'])) {
                // If user is logged in, show Dashboard and Logout
                echo '<li><a href="dashboard.php">Dashboard</a></li>';
                echo '<li><a href="logout.php">Log-out</a></li>';
            } else {
                // If not logged in, show Sign In and Sign Up options
                echo '<li><a href="login.php">Sign In</a></li>';
                echo '<li><a href="signup.php">Sign Up</a></li>';
            }
            ?>
        </ul>
    </li>
</header>

<h1>Edit Car Details</h1>

<form method="POST" action="update_post.php">
    <input type="hidden" name="id" value="<?php echo $car['id']; ?>">
    <label for="name">Car Name:</label>
    <input type="text" id="name" name="name" value="<?php echo $car['name']; ?>" required>
    <br>
    <label for="year">Year:</label>
    <input type="text" id="year" name="year" value="<?php echo $car['year']; ?>" required>
    <br>
    <label for="price">Price:</label>
    <input type="text" id="price" name="price" value="<?php echo $car['price']; ?>" required>
    <br>
    <label for="monthly_price">Monthly Price:</label>
    <input type="text" id="monthly_price" name="monthly_price" value="<?php echo $car['monthly_price']; ?>" required>
    <br>
    <label for="image">Image URL:</label>
    <input type="text" id="image" name="image" value="<?php echo $car['image']; ?>" required>
    <br>
    <button type="submit">Update Car</button>
</form>

</body>
</html>
