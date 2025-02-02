<?php
session_start();

if (!isset($_SESSION['id'])) {
    header('Location: login.php');
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

$user_id = $_SESSION['id'];

$sql = "SELECT cars.name, cars.image, rentals.start_date, rentals.end_date
        FROM rentals
        JOIN cars ON rentals.car_id = cars.id
        WHERE rentals.user_id = ? ";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* General body styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }

        /* Header styling */
        header {
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 20px;
        }

        header h1 {
            margin: 0;
            font-size: 2em;
        }

        header a {
            color: white;
            text-decoration: none;
            font-size: 1.2em;
            margin-left: 20px;
        }

        header a:hover {
            text-decoration: underline;
        }

        /* Navbar styling */
        .navbar {
            display: flex;
            justify-content: center;
            margin-top: 10px;
        }

        .navbar li {
            list-style: none;
            margin: 0 15px;
        }

        .navbar a {
            text-decoration: none;
            color: white;
            font-size: 1.1em;
        }

        .navbar a:hover {
            text-decoration: underline;
        }

        /* Main content styling */
        h2 {
            text-align: center;
            margin-top: 20px;
            font-size: 1.8em;
        }

        /* Table styling */
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #4CAF50;
            color: white;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table td img {
            max-width: 100px;
            height: auto;
        }

    </style>
</head>
<body>

    <!-- Header Section with Navbar -->
    <header>
        <h1>Welcome to your Dashboard</h1>
        <a href="logout.php">Log-out</a>
        <!-- Navbar added here -->
        <ul class="navbar">
            <li><a href="Website.php">Home</a></li>
            <li><a href="ride.php">Ride</a></li>
            <li><a href="service.php">Services</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="reviews.php">Reviews</a></li>
        </ul>
    </header>

    <h2>Your Rented Cars</h2>
    <table border="1">
        <tr>
            <th>Cars</th>
            <th>Image</th>
            <th>Start Date</th>
            <th>End Date</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td><img src="<?php echo htmlspecialchars($row['image']); ?>" width="100"></td>
                <td><?php echo htmlspecialchars($row['start_date']); ?></td>
                <td><?php echo htmlspecialchars($row['end_date']); ?></td>
            </tr>
        <?php endwhile; ?>
    </table>

</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
