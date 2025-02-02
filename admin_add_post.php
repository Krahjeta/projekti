<?php
session_start();
// Ensure the admin is logged in
if (!isset($_SESSION['role']) || !($_SESSION['role'] == 'admin') ) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $servername = "localhost";
    $username = "root";
    $password = ""; // Replace with your password
    $dbname = "car_rental";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Sanitize user input
    $image = $conn->real_escape_string($_POST['image']);
    $year = (int)$_POST['year'];
    $name = $conn->real_escape_string($_POST['name']);
    $price = (float)$_POST['price'];
    $monthly_price = (float)$_POST['monthly_price'];

    // Insert the post into the database using prepared statements
    $stmt = $conn->prepare("INSERT INTO cars (image, year, name, price, monthly_price) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssd", $image, $year, $name, $price, $monthly_price);

    if ($stmt->execute()) {
        $success_message = "Post added successfully!";
    } else {
        $error_message = "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<?php

$servername = "localhost";
$username = "root";
$password = ""; // Replace with your password
$dbname = "car_rental";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch rented cars and schedules
$sql = "SELECT 
            c.name AS car_name, 
            c.year AS car_year, 
            r.start_date, 
            r.end_date, 
            u.email AS user_email
        FROM 
            rentals r
        JOIN 
            cars c ON r.car_id = c.id
        JOIN 
            users u ON r.user_id = u.id
        ORDER BY 
            r.start_date ASC";

$result = $conn->query($sql);

if ($result === false) {
    die("Error: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Add Post</title>
    <link rel="stylesheet" href="style.css">

   <!-- <a href="Website.php" class="logo"><img src="logo.png" alt="logo"></a>-->

    <div class="bx bx-menu" id="menu-icon"></div>

    <ul class="navbar">
        <li><a href="Website.php">Home</a></li>
        <li><a href="ride.php">Ride</a></li>
        <li><a href="service.php">Services</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="reviews.php">Reviews</a></li>
    </ul>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
        }
        form {
            max-width: 500px;
            margin: auto;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        input, button {
            width: 100%;
            margin-bottom: 16px;
            padding: 10px;
            font-size: 16px;
        }
        .message {
            text-align: center;
            margin-bottom: 16px;
        }
        .success {
            color: green;
        }
        .error {
            color: red;
        }
/*----------------------------------*/
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            margin-top: 20px;
        }

        .dashboard-header h1 {
            margin: 0;
        }

        .dashboard-header a {
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .dashboard-header a:hover {
            background-color: #0056b3;
        }
        body.admin-body {
            padding-top: 50px;
            padding-bottom: 50px;
        }
        .dashboard-header a.logout {
    position: absolute;
    /*top: 8px;*/
    right: 20px;
    background-color: #1d33f1;
}

.dashboard-header a.logout:hover {
    background-color: #cc0000;
}
    </style>

</head>
<body class="admin-body">
    <h1>Add a New Post</h1>

    <?php if (isset($success_message)): ?>
        <div class="message success"><?= $success_message ?></div>
    <?php elseif (isset($error_message)): ?>
        <div class="message error"><?= $error_message ?></div>
    <?php endif; ?>

    <form method="POST">
        <label for="image">Image Path</label>
        <input type="text" id="image" name="image" placeholder="e.g., images/car7.jpg" required>

        <label for="year">Year</label>
        <input type="number" id="year" name="year" min="1900" max="2100" required>

        <label for="name">Car Name</label>
        <input type="text" id="name" name="name" placeholder="e.g., Lamborghini Huracan" required>

        <label for="price">Price ($)</label>
        <input type="number" id="price" name="price" step="0.01" required>

        <label for="monthly_price">Monthly Price ($)</label>
        <input type="number" id="monthly_price" name="monthly_price" step="0.01" required>

        <button type="submit">Add Post</button>
    </form>

    <header>
        <div class="dashboard-header">
            <h1>Admin Dashboard</h1>
            <a href="logout.php" class="logout">Logout</a>
        </div>
    </header>

    <h2>Rented Cars and Schedules</h2>
    <table>
        <thead>
            <tr>
                <th>Car Name</th>
                <th>Year</th>
                <th>Rented By</th>
                <th>Start Date</th>
                <th>End Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['car_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['car_year']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['user_email']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['start_date']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['end_date']) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No rentals found.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <?php $conn->close(); ?>
</body>
</html>
