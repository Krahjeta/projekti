<?php
session_start();

// Ensure the user is logged in (redirect if not)
if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit;
}

$servername = "localhost";
$username = "root";
$password = ""; // Replace with your password
$dbname = "car_rental";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch all cars (posts)
$sql = "SELECT * FROM cars";
$result = $conn->query($sql);

// Check if the query was successful
if ($result === false) {
    die("Error: " . $conn->error); // Display the error if the query failed
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Cars</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Cars Section */
        .services-container {
            display: flex;
            flex-wrap: wrap; /* Ensures wrapping on small screens */
            gap: 20px;
            justify-content: center; /* Aligns items in the center */
            padding: 20px;
        }

        /* Individual Car Box */
        .box {
            width: 300px; /* Set a fixed width for each car */
            background: #fff;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            padding: 15px;
            text-align: center;
            transition: transform 0.3s ease-in-out;
        }

        .box:hover {
            transform: scale(1.05);
        }

        /* Car Image */
        .box-img img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 10px;
        }

        /* Car Info */
        .box h3 {
            font-size: 20px;
            margin: 10px 0;
        }

        .box p {
            color: #666;
            font-size: 14px;
        }

        .box h2 {
            font-size: 18px;
            color: #ff5a3c;
        }

        /* Edit Button */
        .box .btn {
            display: inline-block;
            background: #ff5a3c;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 10px;
            transition: background 0.3s;
        }

        .box .btn:hover {
            background: #e04830;
        }
    </style>
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
           // echo '<li><a href="logout.php">Logout</a></li>';
            //echo '<li><a href="user_dashboard.php">Dashboard</a></li>';
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
        <style>
        .avatar {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 50%;
            overflow: hidden;
            border: 0.1rem solid #78828c;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }
    </style>
        <ul>
            <?php
            if (isset($_SESSION['id'])) {
                // If user is logged in, show Dashboard and Logout
                echo '<li><a href="user_dashboard.php">Dashboard</a></li>';
                echo '<li><a href="logout.php">Log-out</a></li>';
            } else {
                // If not logged in, show Sign In and Sign Up options
                //echo '<li><a href="login.php">Sign In</a></li>';
               // echo '<li><a href="signup.php">Sign Up</a></li>';
            }
            ?>
        </ul>
    </li>
</header>


<h1>All Cars</h1>

<section class="services" id="services">
    <div class="services-container">
        <?php
        // Check if there are any cars (posts)
        if ($result->num_rows > 0) {
            // Output each car
            while ($row = $result->fetch_assoc()) {
                echo "<div class='box'>";
                echo "<div class='box-img'>";
                echo "<img src='" . htmlspecialchars($row['image']) . "' alt='" . htmlspecialchars($row['name']) . "'>";
                echo "</div>";
                echo "<p>" . htmlspecialchars($row['year']) . "</p>";
                echo "<h3>" . htmlspecialchars($row['name']) . "</h3>";
                echo "<h2>$" . htmlspecialchars($row['price']) . " | $" . htmlspecialchars($row['monthly_price']) . " <span>/month</span></h2>";
                echo "<a href='edit_post.php?id=" . $row['id'] . "' class='btn'>Edit</a>";
                echo "</div>";
            }
        } else {
            echo "<p>No cars available.</p>";
        }
        ?>
    </div>
</section>

</body>
</html>

<?php
$conn->close();
?>
