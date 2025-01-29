<?php
session_start();  // Always call session_start() at the top
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
            <a href="#" class="sign-up">Sign Up</a>
            <a href="#" class="sign-in">Sign In</a>
        </div>
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

   <!--elzaservices-->
   <section class="services" id="services">
    <div class="heading">
        <span>Best Services</span>
        <h1>Explore Our Top Deals <br> From Top Rated Dealers</h1>
    </div>
    <!-- <div class="services-container">
        <div class="box">
            <div class="box-img">
                <img src="car1.jpg" alt="">
            </div>
            <p>2017</p>
            <h3>Mercedes-Benz E63S</h3>
            <h2>$58500 | $358 <span>/month</span></h2>
            <a href="#" class="btn">Rent Now</a>
        </div>
        <div class="box">
            <div class="box-img">
                <img src="car2.jpg" alt="">
            </div>
            <p>2017</p>
            <h3>Porsche 918 Spyder</h3>
            <h2>$58500 | $358 <span>/month</span></h2>
            <a href="#" class="btn">Rent Now</a>
        </div>
        <div class="box">
            <div class="box-img">
                <img src="car3.jpg" alt="">
            </div>
            <p>2017</p>
            <h3>Audi R8</h3>
            <h2>$58500 | $358 <span>/month</span></h2>
            <a href="#" class="btn">Rent Now</a>
        </div>
        <div class="box">
            <div class="box-img">
                <img src="car4.jpg" alt="">
            </div>
            <p>2017</p>
            <h3>Porsche 911</h3>
            <h2>$58500 | $358 <span>/month</span></h2>
            <a href="#" class="btn">Rent Now</a>
        </div>
        <div class="box">
            <div class="box-img">
                <img src="car5.jpg" alt="">
            </div>
            <p>2017</p>
            <h3>BMW E30</h3>
            <h2>$58500 | $358 <span>/month</span></h2>
            <a href="#" class="btn">Rent Now</a>
        </div>
        <div class="box">
            <div class="box-img">
                <img src="car6.jpg" alt="">
            </div>
            <p>2017</p>
            <h3>Mercedes-Benz GLC</h3>
            <h2>$58500 | $358 <span>/month</span></h2>
            <a href="#" class="btn">Rent Now</a>
        </div>
    </div>  -->

    <div id="services"></div>

<script>
    // Fetch posts from the backend
    fetch('fetch_posts.php')
        .then(response => response.text())
        .then(data => {
            document.getElementById('services').innerHTML = data;
        })
        .catch(error => console.error('Error fetching posts:', error));
</script>

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