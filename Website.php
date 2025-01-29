<?php
include 'config.php';
if(isset($_POST['submit'])){
$name = mysqli_real_escape_string($conn,$_POST['username']);
$email = mysqli_real_escape_string($conn,$_POST['email']);
$pass = mysqli_real_escape_string($conn,$_POST['password']);
$cpass = mysqli_real_escape_string($conn,$_POST['cpassword']);
$user_type = $_POST['user_type'];
$select_user = mysqli_query($conn,"SELECT * FROM users WHERE email='$email' AND password = '$pass'") or die('query failed');

if(mysqli_num_rows($select_user) > 0 ){
    $message[] = 'user already exists!';
}
else{
    if($pass != $cpass){
     $message[] = 'confirm password not matched';
    }
    else{
        mysqli_query($conn,"INSERT INTO users (name, email, password, user_type) 
        VALUES ('$name','$email', '$cpass','$user_type') ")or die('query failed');
        $message[] = 'registered successfully';
    }
}

ini_set('display_errors', 1);
error_reporting(E_ALL);
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
    <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/solid.css">
</head>
<body>
    <header>
        <a href="#" class="logo"><img src="logo.png" alt="logo" ></a>

        <div class="bx bx-menu" id="menu-icon"></div>

        <ul class="navbar">
            <li><a href="Website.php">Home</a></li>
            <li><a href="ride.php">Ride</a></li>
            <li><a href="service.php">Services</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="reviews.php">Reviews</a></li>
        
        
        <div class="header-btn">
            <a href="#" class="sign-up">Sign Up</a>
            <a href="#" class="sign-in">Sign In</a>
        </div>
        <li class="nav-profil">
                <div class="avatar">
                    <img src="rev1.jpg" alt="">

                </div>
                <ul>
                    <li><a href="dashboard.html">Dashboard</a></li>
                    <li><a href="logout.html">Log-out</a></li>
                </ul>
            </li>
            </ul>
            <!--<button id="open_nav-btn"><i class="uis uis-bars"></i></button>-->
        <!--<button id="close_nav-btn"><i class="uis uis-times"></i></button>-->
    </header>
<!--Krahjeta-->
<?php
if(isset($message)){
    foreach($message as $msg){
        echo '
        <div class ="message">
        <span>'.htmlspecialchars($msg).'</span>
        <i class = "fas fa-time" onclick="this.parentElement.remove();"></i>
        </div>
        ';
    }
}


?>

   <div class="modal" id="signUpModal">
   <div class="modal-content">
    <span class="close" id="closeSignUp">&times;</span>
    <h2>Sign Up</h2>
    <form id="signUpForm"  method="POST" action="">
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
        <input type="password" id="signUpPassword" name="password" placeholder="Enter password" required>
        <ion-icon name="lock-closed-outline" class="icon"></ion-icon>
        </div>
        <label for="signUpConfirmPassword"> Confirm Password:</label>
        <div class="input-container">
        <input type="password" id="signUpConfirmPassword" name="cpassword" placeholder="Confirm your password" required>
        <ion-icon name="lock-closed-outline" class="icon"></ion-icon>
        </div>
        <select name="user_type" class="box" required>
        <option value="user">user</option>
        <option value="admin">admin</option>
        </select>
        <button type="submit" name="submit">Sign Up</button>
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


    <!--Krahjeta-->
<section class="home" id="home">
    <div class="text">
        <h1><span>Looking</span> for a <br>car to rent?</h1>
        <p>Download now on App Store and Google Play</p>
        <div class="app-store">
            
              <img src="appStore.webp" alt="Aplikacioni IOS"width="200" height="54" >
              <img src="googlePlay.webp" alt="Aplikacioni Android" width="200" height="54" style="margin-inline-start: 10px;">

        </div>
        <div class="form-container">
            <form >
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
                    <input type="date"required>
                </div>
                <input type="submit" class="btn" value="Search">
            </form>
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