<?php
session_start();
$error_message = "";

if (isset($_SESSION['id'])) {

    if ($_SESSION['role'] === 'admin') {
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
    $password = ""; 
    $dbname = "car_rental";


    $conn = new mysqli($servername, $username, $password, $dbname);


    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $email = $_POST['email'];
    $user_password = $_POST['password'];


    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();


    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($user_password, $user['password'])) {

            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role']; 
            $_SESSION['id'] = $user['id']; 


            if ($user['role'] === 'admin') {
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

</head>
<body>
<header>

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
