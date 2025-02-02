<?php
session_start();
require_once 'Database.php';
require_once 'User.php';

$database = new Database();
$db = $database->connect();
$user = new User($db);


$stmt = $db->prepare("SELECT section_name, content FROM page_content WHERE page_name = 'home'");
$stmt->execute();
$content = $stmt->fetchAll(PDO::FETCH_ASSOC);

$pageContent = [];
foreach ($content as $item) {
    $pageContent[$item['section_name']] = $item['content'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $rolw = $_POST['role'];

    if ($password !== $cpassword) {
        $message[] = 'Passwords do not match';
    } else {
        if ($user->register($username, $email, $password, $role)) {
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
           
            echo '<li><a href="logout.php">Logout</a></li>';
            echo '<li><a href="dashboard_admin.php">Dashboard</a></li>';
        } else {
      
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
              
                echo '<li><a href="dashboard_admin.php">Dashboard</a></li>';
                echo '<li><a href="logout.php">Log-out</a></li>';
            } else {
              
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
        <form id="signUpForm" method="POST">
            <label for="signUpUsername">Username:</label>
            <div class="input-container">
                <ion-icon name="person-outline" class="icon"></ion-icon>
                <input type="text" id="signUpUsername" name="username" placeholder="Enter Username" required>
            </div>

            <label for="signUpEmail">Email:</label>
            <div class="input-container">
                <ion-icon name="mail-outline" class="icon"></ion-icon>
                <input type="email" id="signUpEmail" name="email" placeholder="Enter Email" required>
            </div>

            <label for="signUpPassword">Password:</label>
            <div class="input-container">
                <ion-icon name="lock-closed-outline" class="icon"></ion-icon>
                <input type="password" id="signUpPassword" name="password" placeholder="Enter Password" required>
            </div>

            <label for="signUpConfirmPassword">Confirm Password:</label>
            <div class="input-container">
                <ion-icon name="lock-closed-outline" class="icon"></ion-icon>
                <input type="password" id="signUpConfirmPassword" name="cpassword" placeholder="Confirm Your Password" required>
            </div>

            <label for="userType">User Type:</label>
            <select name="role" id="role" class="box" required>
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>

            <button type="submit" name="submit">Sign Up</button>
            <!-- Notification Box -->
            <div id="notificationBox" class="hidden"></div>

        </form>
    </div>
</div>

<script>
    document.getElementById('signUpForm').addEventListener('submit', function(event) {
    event.preventDefault(); 

    const formData = new FormData(this);

    fetch('signup.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            showNotification('Sign-up successful!', false);

            document.getElementById('signUpModal').classList.remove('active');

            document.getElementById('signUpForm').reset();
        } else {
            showNotification(data.message, true);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('An error occurred. Please try again.', true);
    });
});

function showNotification(message, isError = false) {
    const notificationBox = document.getElementById('notificationBox');
    notificationBox.textContent = message;

    if (isError) {
        notificationBox.classList.add('error');
    } else {
        notificationBox.classList.remove('error');
    }

    notificationBox.style.display = 'block';

    setTimeout(() => {
        notificationBox.style.display = 'none';
    }, 5000);
}

</script>


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
        <h1>
            <span><?php echo htmlspecialchars($pageContent['headline_prefix'] ?? 'Looking'); ?></span> 
            for a <br>
            <?php echo htmlspecialchars($pageContent['headline_suffix'] ?? 'car to rent?'); ?>
        </h1>
        <p><?php echo htmlspecialchars($pageContent['sub_text'] ?? 'Download now on App Store and Google Play'); ?></p>
        <div class="app-store">
            <img src="appStore.webp" alt="Aplikacioni IOS" width="200" height="54">
            <img src="googlePlay.webp" alt="Aplikacioni Android" width="200" height="54" style="margin-inline-start: 10px;">
        </div>
        <div class="form-container">
            <form>
                <div class="input-box">
                    <span><?php echo htmlspecialchars($pageContent['form_label_location'] ?? 'Location'); ?></span>
                    <input type="text" placeholder="Search Places" required>
                </div>
                <div class="input-box">
                    <span><?php echo htmlspecialchars($pageContent['form_label_pickup'] ?? 'Pick-Up Date'); ?></span>
                    <input type="date" required>
                </div>
                <div class="input-box">
                    <span><?php echo htmlspecialchars($pageContent['form_label_return'] ?? 'Return Date'); ?></span>
                    <input type="date" required>
                </div>
                <input type="submit" class="btn" value="Search">
            </form>
        </div>
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
