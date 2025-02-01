<?php
session_start();
require_once 'Database.php';

$database = new Database();
$conn = $database->connect();

$stmt = $conn->prepare("SELECT section_name, content FROM page_content WHERE page_name = 'reviews'");
$stmt->execute();

$pageContent = $stmt->fetchAll(PDO::FETCH_ASSOC);

$reviewsData = [];
foreach ($pageContent as $item) {
    $reviewsData[$item['section_name']] = $item['content'];
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
   <section class="reviews" id="reviews">
    <div class="heading">
        <span>Reviews</span>
        <h1><?php echo htmlspecialchars($reviewsData['main_heading'] ?? 'Trusted by Thousands of Customers'); ?></h1>
    </div>
    <div class="reviews-container">
        
        <div class="box">
            <div class="rev-img">
                <img src="<?php echo htmlspecialchars($reviewsData['review_1_image'] ?? 'rev1.jpg'); ?>" alt="<?php echo htmlspecialchars($reviewsData['review_1_name'] ?? 'Daniel'); ?>">
            </div>
            <h2><?php echo htmlspecialchars($reviewsData['review_1_name'] ?? 'Daniel'); ?></h2>
            <div class="stars">
                <?php
                $rating = floatval($reviewsData['review_1_rating'] ?? 4.5);
                $fullStars = floor($rating);
                for ($i = 0; $i < $fullStars; $i++) {
                    echo "<i class='bx bxs-star'></i>";
                }
                if ($rating - $fullStars >= 0.5) {
                    echo "<i class='bx bxs-star-half'></i>";
                }
                ?>
            </div>
            <p><?php echo htmlspecialchars($reviewsData['review_1_content'] ?? 'The car options are fantastic, and the prices are super competitive.'); ?></p>
        </div>

        <div class="box">
            <div class="rev-img">
                <img src="<?php echo htmlspecialchars($reviewsData['review_2_image'] ?? 'rev2.jpg'); ?>" alt="<?php echo htmlspecialchars($reviewsData['review_2_name'] ?? 'Andrea'); ?>">
            </div>
            <h2><?php echo htmlspecialchars($reviewsData['review_2_name'] ?? 'Andrea'); ?></h2>
            <div class="stars">
                <?php
                $rating = floatval($reviewsData['review_2_rating'] ?? 4.5);
                $fullStars = floor($rating);
                for ($i = 0; $i < $fullStars; $i++) {
                    echo "<i class='bx bxs-star'></i>";
                }
                if ($rating - $fullStars >= 0.5) {
                    echo "<i class='bx bxs-star-half'></i>";
                }
                ?>
            </div>
            <p><?php echo htmlspecialchars($reviewsData['review_2_content'] ?? 'I loved how easy it was to book a car!'); ?></p>
        </div>

        <div class="box">
            <div class="rev-img">
                <img src="<?php echo htmlspecialchars($reviewsData['review_3_image'] ?? 'rev3.jpg'); ?>" alt="<?php echo htmlspecialchars($reviewsData['review_3_name'] ?? 'Liam'); ?>">
            </div>
            <h2><?php echo htmlspecialchars($reviewsData['review_3_name'] ?? 'Liam'); ?></h2>
            <div class="stars">
                <?php
                $rating = floatval($reviewsData['review_3_rating'] ?? 5);
                $fullStars = floor($rating);
                for ($i = 0; $i < $fullStars; $i++) {
                    echo "<i class='bx bxs-star'></i>";
                }
                ?>
            </div>
            <p><?php echo htmlspecialchars($reviewsData['review_3_content'] ?? 'The design of the website is sleek and modern.'); ?></p>
        </div>
    </div>
</section>

   <section class="newsletter">
    <h2>Subscribe To Newsletter</h2>
    <div class="box">
        <input type="text" placeholder="Enter Your Email...">
        <a href="#" class="btn">Subscribe</a>
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