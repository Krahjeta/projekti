<?php
// Start a session and check if the admin is logged in
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
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

    // Insert the post into the database
    $sql = "INSERT INTO cars (image, year, name, price, monthly_price) VALUES ('$image', $year, '$name', $price, $monthly_price)";
    if ($conn->query($sql) === TRUE) {
        $success_message = "Post added successfully!";
    } else {
        $error_message = "Error: " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Add Post</title>
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
    </style>
</head>
<body>
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
</body>
</html>
