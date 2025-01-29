<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental Website</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

    <!--<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>-->
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
   <Section class="ride" id="ride">

    <div class="heading">
    <span>How it works</span>
    <h1>Rent With 3 Easy Steps</h1>
    </div>
    <div class="ride-container">
        <div class="box">
    <i class='bx bx-map'></i>
    <h2>Choose A Location</h2>
    <p>Select the city where you would like to start your journey by picking up your rental car or conveniently return it at the end of your trip.</p>
    </div>
        <div class="box">
        <i class='bx bx-calendar-edit' ></i>
    <h2>Pick-Up Date</h2>
    <p>Choose your desired pick-up and return dates to customize your rental based on the days you need the car.</p>
    </div>
        <div class="box">
            <i class='bx bxs-car-garage'></i>
    <h2>Book A Car</h2>
    <p>Reserve your car today to guarantee the ideal vehicle, ensuring a comfortable and hassle-free travel experience.</p>
    </div>
    </div>

</Section>
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