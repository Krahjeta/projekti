<?php
session_start();  // Start the session to manage session data
require_once 'Database.php';
require_once 'User.php';

// Initialize Database and User objects
$database = new Database();
$db = $database->connect();
$user = new User($db);

// Handle sign-up form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $user_type = $_POST['user_type'];

    if ($password !== $cpassword) {
        $message[] = 'Passwords do not match';
    } else {
        if ($user->register($username, $email, $password, $user_type)) {
            $message[] = 'Sign-up successful';
        } else {
            $message[] = 'Sign-up failed. User might already exist.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental Website</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/solid.css">
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
            echo '<a href="#" class="sign-up" id="signUpBtn">Sign Up</a>';
            echo '<a href="#" class="sign-in" id="signInBtn">Sign In</a>';
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

<!-- Display messages -->
<?php
if (isset($message)) {
    foreach ($message as $msg) {
        echo '
        <div class="message">
        <span>' . htmlspecialchars($msg) . '</span>
        <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
        </div>
        ';
    }
}
?>

<!-- Sign Up Modal -->
<div class="modal" id="signUpModal">
    <div class="modal-content">
        <span class="close" id="closeSignUp">&times;</span>
        <h2>Sign Up</h2>
        <form id="signUpForm" method="POST" action="signup.php">
            <label for="signUpUsername">Username:</label>
            <div class="input-container">
                <input type="text" id="signUpUsername" name="username" placeholder="Enter Username" required>
                <ion-icon name="person-outline" class="icon"></ion-icon>
            </div>
            <label for="signUpEmail">Email:</label>
            <div class="input-container">
                <input type="email" id="signUpEmail" name="email" placeholder="Enter Email" required>
                <ion-icon name="mail-outline" class="icon"></ion-icon>
            </div>
            <label for="signUpPassword">Password:</label>
            <div class="input-container">
                <input type="password" id="signUpPassword" name="password" placeholder="Enter Password" required>
                <ion-icon name="lock-closed-outline" class="icon"></ion-icon>
            </div>
            <label for="signUpConfirmPassword">Confirm Password:</label>
            <div class="input-container">
                <input type="password" id="signUpConfirmPassword" name="cpassword" placeholder="Confirm Your Password" required>
                <ion-icon name="lock-closed-outline" class="icon"></ion-icon>
            </div>
            <label for="userType">User Type:</label>
            <select name="user_type" id="userType" class="box" required>
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
            <button type="submit" name="submit">Sign Up</button>
        </form>
    </div>
</div>

<!-- Sign In Modal -->
<?php if (!isset($_SESSION['id'])): ?>
<div class="modal" id="signInModal">
    <div class="modal-content">
        <span class="close" id="closeSignIn">&times;</span>
        <h2>Sign In</h2>
        <form id="signInForm" method="POST" action="login.php">
            <label for="signInEmail">Email:</label>
            <div class="input-container">
                <input type="email" id="signInEmail" name="email" placeholder="Enter Email" required>
                <ion-icon name="mail-outline" class="icon"></ion-icon>
            </div>
            <label for="signInPassword">Password:</label>
            <div class="input-container">
                <input type="password" id="signInPassword" name="password" placeholder="Enter Password" required>
                <ion-icon name="lock-closed-outline" class="icon"></ion-icon>
            </div>
            <button type="submit">Sign In</button>
            <?php if (isset($error_message)) echo "<p>$error_message</p>"; ?>
        </form>
    </div>
</div>
<?php endif; ?>

<!-- Home Section -->
<section class="home" id="home">
    <div class="text">
        <h1><span>Looking</span> for a <br>car to rent?</h1>
        <p>Download now on App Store and Google Play</p>
        <div class="app-store">
              <img src="appStore.webp" alt="Aplikacioni IOS" width="200" height="54" >
              <img src="googlePlay.webp" alt="Aplikacioni Android" width="200" height="54" style="margin-inline-start: 10px;">
        </div>
        <div class="form-container">
            <form>
                <div class="input-box">
                    <span>Location</span>
                    <input type="text" placeholder="Search Places" required>
                </div>
                <div class="input-box">
                    <span>Pick-Up Date</span>
                    <input type="date" required>
                </div>
                <div class="input-box">
                    <span>Return Date</span>
                    <input type="date" required>
                </div>
                <input type="submit" class="btn" value="Search">
            </form>
        </div>
</section>

<!-- Footer -->
<footer>
    <div class="copyright">
        <p>© 2024 Car Rental. All rights reserved.</p>
        <div class="social">
            <a href="#"><i class='bx bxl-facebook'></i></a>
            <a href="#"><i class='bx bxl-twitter'></i></a>
            <a href="#"><i class='bx bxl-instagram'></i></a>
        </div>
    </div>
</footer>

<script src="main.js"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
