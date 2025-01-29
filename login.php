<?php
session_start();
$error_message = "";

// Check if the user is already logged in
if (isset($_SESSION['id'])) {
    // Redirect based on role
    if ($_SESSION['user_role'] === 'admin') {
        header('Location: admin_add_post.php');
        exit;
    } else {
        header('Location: user_edit_post.php');
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

    $email = $_POST['email'];
    $user_password = $_POST['password'];

    // Prepare and bind the statement to avoid SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the user exists
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($user_password, $user['password'])) {
            // Password is correct, store user data in the session
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_role'] = $user['user_type']; // Assuming user_type is the role (user/admin)
            $_SESSION['id'] = $user['id']; // Store user ID

            // Redirect based on role
            if ($user['user_type'] === 'admin') {
                header('Location: admin_add_post.php');
            } else {
                header('Location: user_edit_post.php');
            }
            exit;
        } else {
            $error_message = "Invalid email or password.";
        }
    } else {
        $error_message = "Invalid email or password.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <a href="Website.php" class="logo"><img src="logo.png" alt="logo"></a>
</header>

<div class="login-container">
    <h2>Login</h2>

    <?php if (!empty($error_message)) { echo "<p class='error'>$error_message</p>"; } ?>

    <form method="POST" action="login.php">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>
