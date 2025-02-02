<?php
session_start();
require_once 'Database.php';

$database = new Database();
$conn = $database->connect();

$stmt = $conn->prepare("SELECT section_name, content FROM page_content WHERE page_name = 'about'");
$stmt->execute();

$content = $stmt->fetchAll(PDO::FETCH_ASSOC);

$pageContent = [];
foreach ($content as $item) {
    $pageContent[$item['section_name']] = $item['content'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental Website</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
</head>
<body>
    <header>
        <a href="#" class="logo"><img src="logo.png" alt="" srcset=""></a>

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
           
           // echo '<li><a href="logout.php">Logout</a></li>';
            //echo '<li><a href="dashboard_admin.php">Dashboard</a></li>';
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
              
                echo '<li><a href="dashboard_admin.php">Dashboard</a></li>';
                echo '<li><a href="logout.php">Log-out</a></li>';
            } else {
              
               // echo '<li><a href="login.php">Sign In</a></li>';
               // echo '<li><a href="signup.php">Sign Up</a></li>';
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
<!--Krahjeta-->
   <div class="modal" id="signUpModal">
   <div class="modal-content">
    <span class="close" id="closeSignUp">&times;</span>
    <h2>Sign Up</h2>
    <form id="signUpForm">
        <label for="signUpUsername">Username:</label>
        <div class="input-container">
        <input type="text" id="signUpUsername" placeholder="Enter Username" required>
        <ion-icon name="person-outline" class="icon"></ion-icon>
        </div>
        <label for="signUpEmail">Email:</label>
        <div class="input-container">
        <input type="email" id="signUpEmail" placeholder="Enter Email" required>
        <ion-icon name="mail-outline" class="icon"></ion-icon>
        </div>
        <label for="signUpPassword">Password:</label>
        <div class="input-container">
        <input type="password" id="signUpPassword" placeholder="Enter password" required>
        <ion-icon name="lock-closed-outline" class="icon"></ion-icon>
        </div>
        <button type="submit">Sign Up</button>
    </form>

   </div>
   </div>

   <div class="modal" id="signInModal">
    <div class="modal-content">
     <span class="close" id="closeSignIn">&times;</span>
     <h2>Sign In</h2>
     <form id="signInForm">
        <label for="signInEmail">Email:</label>
        <div class="input-container">
        <input type="email" id="signInEmail" placeholder="Enter Email" required>
        <ion-icon name="mail-outline" class="icon"></ion-icon>
        </div>
        <label for="signInPassword">Password:</label>
        <div class="input-container">
        <input type="password" id="signInPassword" placeholder="Enter password" required>
        <ion-icon name="lock-closed-outline" class="icon"></ion-icon>
        </div>
        <button type="submit">Sign In</button>
     </form>
    </div>
   </div>

   <!--elzaabout-->
   <section class="about" id="about">
    <div class="heading">
        <span><?php echo htmlspecialchars($pageContent['section_title'] ?? 'About Us'); ?></span>
        <h1><?php echo htmlspecialchars($pageContent['main_heading'] ?? 'Best Customer Experience'); ?></h1>
    </div>
    <div class="about-container">
        <div class="about-img">
            <img src="about.avif" alt="">
        </div>
        <div class="about-text">
            <span><?php echo htmlspecialchars($pageContent['about_subheading'] ?? 'About Us'); ?></span>
            <p><?php echo nl2br(htmlspecialchars($pageContent['paragraph_1'] ?? 'Welcome to our car rental website, your trusted partner for reliable and affordable car rentals. Whether it\'s a weekend getaway, a family vacation, or a business trip, we have the perfect vehicle for your journey.')); ?></p>
            <p><?php echo nl2br(htmlspecialchars($pageContent['paragraph_2'] ?? 'Our mission is to make car rentals easy, accessible, and hassle-free. With a diverse fleet of well-maintained vehicles, competitive pricing, and flexible rental terms, we\'re here to ensure your travel plans go smoothly. From compact cars to spacious SUVs, we\'ve got you covered.')); ?></p>
            <p><?php echo nl2br(htmlspecialchars($pageContent['paragraph_3'] ?? 'Your comfort and safety are our top priorities. Every vehicle is regularly inspected and sanitized to meet the highest standards. Plus, with our friendly customer support team available 24/7, help is always just a call away.')); ?></p>
            <p><?php echo nl2br(htmlspecialchars($pageContent['paragraph_4'] ?? 'Thank you for choosing our website. Let\'s hit the road together! Whether it\'s a short trip or a grand adventure, we\'re here to make your travels unforgettable.')); ?></p>
            <a href="#" class="btn">Learn More</a>
        </div>
    </div>
</section>

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