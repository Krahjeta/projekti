<?php
session_start();
require_once 'Database.php';

$database = new Database();
$conn = $database->connect();

$stmt = $conn->prepare("SELECT section_name, content FROM page_content WHERE page_name = 'ride'");
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
<div class="page-container">
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
           // echo '<li><a href="logout.php">Logout</a></li>';
           // echo '<li><a href="dashboard.php">Dashboard</a></li>';
        } else {
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
            
                echo '<li><a href="admin_add_post.php">Dashboard</a></li>';
                echo '<li><a href="logout.php">Log-out</a></li>';
            } else {
                
              //  echo '<li><a href="login.php">Sign In</a></li>';
               // echo '<li><a href="signup.php">Sign Up</a></li>';
            }
            ?>
        </ul>
    </li>
</header>
<!--Krahjeta-->
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
           

        </form>
    </div>
</div>
<div id="notification"></div>


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
}
else {
    showNotification(data.message, true);
}

    })
    .catch(error => {
        showNotification('An error occurred. Please try again.', true);
    });
});


function showNotification(message, isError) {
    const notificationElement = document.getElementById('notification');

    notificationElement.innerText = message;

    notificationElement.style.backgroundColor = isError ? 'red' : 'green';

    
    notificationElement.style.display = 'block';
    setTimeout(() => {
        notificationElement.style.opacity = 1;
    }, 10);  

  
    setTimeout(() => {
        notificationElement.style.opacity = 0;
        setTimeout(() => {
            notificationElement.style.display = 'none';
        }, 500); 
    }, 3000); 
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
   <div class="content">
   <section class="ride" id="ride">
    <div class="heading">
        <span>How it works</span>
        <h1><?php echo htmlspecialchars($pageContent['heading']); ?></h1>
    </div>
    <div class="ride-container">
        <div class="box">
            <i class='bx bx-map'></i>
            <h2><?php echo htmlspecialchars($pageContent['step_1']); ?></h2>
            <p>Select the city where you would like to start your journey by picking up your rental car or conveniently return it at the end of your trip.</p>
        </div>
        <div class="box">
            <i class='bx bx-calendar-edit'></i>
            <h2><?php echo htmlspecialchars($pageContent['step_2']); ?></h2>
            <p>Choose your desired pick-up and return dates to customize your rental based on the days you need the car.</p>
        </div>
        <div class="box">
            <i class='bx bxs-car-garage'></i>
            <h2><?php echo htmlspecialchars($pageContent['step_3']); ?></h2>
            <p>Reserve your car today to guarantee the ideal vehicle, ensuring a comfortable and hassle-free travel experience.</p>
        </div>
    </div>
</section>
   </div>
   <section class="featured-cars" id="featured-cars"> 
    <div class="heading">
        <span>Top Picks</span>
        <h1>Featured Rental Cars</h1>
    </div>
    <div class="featured-container">
        <div class="car-box">
            <img src="images/toyota-corolla.jpg" alt="Car 1">
            <h3>Toyota Corolla</h3>
            <p>Reliable and fuel-efficient sedan.</p>
            <h2>$40/day</h2>
        </div>
        <div class="car-box">
            <img src="images/Ford-Mustang.jpg" alt="Car 2">
            <h3>Ford Mustang</h3>
            <p>Powerful and stylish sports car.</p>
            <h2>$90/day</h2>
        </div>
        <div class="car-box">
            <img src="images/Jeep-Wrangler.jpg" alt="Car 3">
            <h3>Jeep Wrangler</h3>
            <p>Perfect for off-road adventures.</p>
            <h2>$75/day</h2>
        </div>
    </div>
</section>

<style>
    .featured-container {
        display: flex;
        justify-content: center;
        gap: 20px;
        flex-wrap: wrap;
        padding: 20px;
    }
    .car-box {
        width: 300px;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        text-align: center;
        padding: 15px;
        transition: transform 0.3s ease-in-out;
    }
    .car-box:hover {
        transform: scale(1.05);
    }
    .car-box img {
        width: 100%;
        height: 180px;
        object-fit: cover;
        border-radius: 10px;
    }
    .car-box h3 {
        margin: 10px 0;
        font-size: 20px;
    }
    .car-box p {
        color: #666;
        font-size: 14px;
    }
    .car-box h2 {
        color: #ff5a3c;
        font-size: 18px;
    }
</style>

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
</div>

   <script src="main.js"></script>
   <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>
</html>