<?php
session_start();

// Ensure the user is logged in and is an admin
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
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
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <style>
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
    </style>
</head>
<body>
    <header>
        <div class="dashboard-header">
            <h1>Admin Dashboard</h1>
            <a href="logout.php">Logout</a>
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