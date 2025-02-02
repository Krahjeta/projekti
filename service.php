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
                //echo '<li><a href="signup.php">Sign Up</a></li>';
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

   <!--elzaservices-->
   <section class="services" id="services">
    <div class="heading">
        <span>Best Services</span>
        <h1>Explore Our Top Deals <br> From Top Rated Dealers</h1>
    </div>
    <div class="carousel-container">
        <button class="carousel-btn prev-btn">&#10094;</button>
        <div class="carousel-track-container">
            <div class="carousel-track services-container" id="carousel-track"></div>
        </div>
        <button class="carousel-btn next-btn">&#10095;</button>   
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
    <div class="modal" id="rentModal">
    <div class="modal-content">
        <span class="close" id="closeRentModal">&times;</span>
        <h2>Choose Rental Dates</h2>
        <form id="rentalForm" method="POST">
            <label for="car_id">Car ID:</label>
            <input type="number" name="car_id" id="car_id" required readonly>

            <label for="start_date">Start Date:</label>
            <input type="date" name="start_date" id="start_date" required>

            <label for="end_date">End Date:</label>
            <input type="date" name="end_date" id="end_date" required>

            <button type="submit">Rent Car</button>
        </form>

        <!-- Message will appear here -->
        <div id="rentalMessage"></div>
    </div>
</div>



    <div id="services"></div>

<script>
 document.addEventListener('DOMContentLoaded', function () {
    const track = document.getElementById('carousel-track');
    const nextButton = document.querySelector('.next-btn');
    const prevButton = document.querySelector('.prev-btn');
    const rentButton = [];


    let currentSlide = 0;

    fetch('fetch_posts.php')
        .then(response => response.text())
        .then(data => {
            track.innerHTML = data;
            setupCarousel();

            updateRentNowButton();
        })
        .catch(error => console.error('Error fetching posts:', error));

    function setupCarousel() {
        const slides = Array.from(track.children);
        const slideWidth = slides[0].offsetWidth;

        nextButton.addEventListener('click', () => moveSlide(1, slides, slideWidth));
        prevButton.addEventListener('click', () => moveSlide(-1, slides, slideWidth));

        // Set initial position
        track.style.transform = `translateX(0px)`;
    }

    function moveSlide(direction, slides, slideWidth) {
        const totalSlides = slides.length;
        currentSlide += direction;

        track.style.transition = 'transform 0.5s ease-in-out';
        track.style.transform = `translateX(-${currentSlide * slideWidth}px)`;

        track.addEventListener('transitionend', () => {
            if (currentSlide >= totalSlides) {
              
                track.style.transition = 'none';
                currentSlide = 0;
                track.style.transform = `translateX(0px)`;
            } else if (currentSlide < 0) {
            
                track.style.transition = 'none';
                currentSlide = totalSlides - 1;
                track.style.transform = `translateX(-${currentSlide * slideWidth}px)`;
            }
        }, { once: true });
    }
    function updateRentNowButton() {
    const rentButtons = document.querySelectorAll('.carousel-container .btn');

    rentButtons.forEach(button => {
        button.addEventListener("click", function (event) {
            event.preventDefault();
            const carId = this.getAttribute("data-car-id"); // Get the car ID from the button's data attribute

            // Check if the user is logged in
            fetch("check_login.php")
                .then(response => response.json())
                .then(data => {
                    if (data.logged_in) {
                        showRentModal(carId);  // Show rental dates modal and pass the car ID
                    } else {
                        alert("Please log in first!");  // Prompt to log in
                    }
                })
                .catch(error => console.error("Error:", error));
        });
    });
}

function showRentModal(carId) {
    document.getElementById("car_id").value = carId;  // Automatically set the car_id input value
    document.getElementById("rentModal").style.display = "block";  // Show the modal
}


    // Close the rent modal
    document.getElementById("closeRentModal").addEventListener("click", function () {
        document.getElementById("rentModal").style.display = "none";
    });
    // Open the modal and set the car ID when a "Rent Now" button is clicked
document.querySelectorAll('.btn').forEach(button => {
    button.addEventListener('click', function() {
        const carId = this.getAttribute('data-car-id'); // Get the car ID from the button
        document.getElementById('car_id').value = carId; // Set the car ID in the modal form
        document.getElementById('rentModal').style.display = 'block'; // Show the modal
    });
});

// Close the modal when the close button is clicked
document.getElementById('closeRentModal').addEventListener('click', function() {
    document.getElementById('rentModal').style.display = 'none';
});



    // Optional: Close the modal when clicking outside of it
    window.addEventListener("click", function(event) {
        if (event.target == document.getElementById("rentModal")) {
            document.getElementById("rentModal").style.display = "none";
        }
    });
});

</script>
<script>
       document.getElementById('rentalForm').addEventListener('submit', function(event) {
    event.preventDefault();  // Prevent default form submission

    const formData = new FormData(this);

    fetch('proces_rental.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) throw new Error('Network response was not ok');
        return response.json();  // Expect JSON response
    })
    .then(data => {
        const messageDiv = document.getElementById('rentalMessage');
        if (data.success) {
            messageDiv.innerHTML = `<span style="color: green;">${data.message}</span>`;
        } else {
            messageDiv.innerHTML = `<span style="color: red;">${data.message}</span>`;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById('rentalMessage').innerHTML = `<span style="color: red;">Error processing request.</span>`;
    });
});

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