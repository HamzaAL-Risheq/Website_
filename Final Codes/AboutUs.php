<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <!-- Meta Description -->
    <meta name="description" content="Learn about Addition Company, a leading innovator in technology solutions. Discover our mission, 
    values, and commitment to excellence in delivering cutting-edge products and services.">
    
    <!-- Keywords -->
    <meta name="keywords" content="Addition Company">
    
    <!-- Robots Meta Tag -->
    <meta name="robots" content="index, follow">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="indexStyleSheet.css">
    <style>
        .image-container {
            
            top: 11%;
        }
        .image-container2 {
            width: 100%; 
        }
        @media only screen and (max-width: 400px) {

            .img1 {
                position: relative;
                bottom: 120%;
                left: 6%;
                width: 85%;
            }
            .img2 {
                position: relative;
                bottom: -37%;
                left: -1%;
                width: 70%;
            }
            .paragraph-container {
                position: relative;
                left: -1%;
                top: 5%;
            }
            .paragraph-container2 {
                position: relative;
                left: -1%;
                top: 2%;
                width: 110%; 
                font-size: 10px; 
                font-weight: 550;
            }       
        }
        @media only screen and (max-width: 1200px) {

            .img1 {
                position: relative;
                bottom: 110%;
                left: 8%;
                width: 76%;
            }
            .img2 {
                position: relative;
                bottom: -35%;
                left: -1%;
                width: 70%;
            }
            .paragraph-container {
                position: relative;
                left: -1%;
                top: 6%;
            }
            .paragraph-container2 {
                position: relative;
                left: -1%;
                top: 2%;
                width: 110%; 
                font-size: 10px; 
                font-weight: 550;
            }       
        }

    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="logo-container">
                <a href ='index.php'>
                    <img class="company-logo" src="2.jpeg" alt="Company Logo">
                </a>
                <div class="company-name">Addition</div>
                <i class="user-logo fas fa-user" onclick="toggleProfilePopup()"></i>
            </div>
        </div>
        <!-- Navigation Bar -->
        <div class="navbar">
            <div class="navbar-left">
                <ul>
                    <li><a href="index.php" class = "AboutUs">Home</a></li>
                    <li><a href="ADDPOST.php"class = "Askforhelp"><i class="fa fa-paper-plane"></i>Add to this world!</a></li>
                    <li><a class = "Blogs" href="PostedBlogs.php"><i class="fas fa-address-book"></i>Blogs</a></li>
                </ul>
            </div>
            <div class="navbar-right">
                <!-- Search Bar -->
                <div class="search-bar">
                    <button class="search-button" type="button"><i class="fas fa-search search-icon"></i></button>
                    <input type="text" class="search-input" placeholder="Search...">
                </div>
            </div>
        </div>
        <!-- Main content body -->
        <div class="main-content">
            <div class="image-container">
                <img class="img1" src="image3.jpeg" class="homepage1">
            </div>
            <div class="paragraph-container">
                <p class="advantagesofblogging1" style="font-size: 20px;">
                    Welcome to Addition – your gateway to knowledge empowerment. We are a passionate team dedicated to spreading the wealth of knowledge across the globe. 
                    In a world where information is power, we believe in democratizing it, making it accessible to everyone, everywhere. 
                    Our journey began with a simple yet profound idea: to create a platform where individuals, regardless of their background or location, can share their insights, expertise, and stories. 
                    We understand that every voice matters, and through our platform, we aim to amplify those voices, fostering a global community of learners, 
                    teachers, and curious minds. With our unwavering commitment to the pursuit of knowledge, we invite you to join us on this enriching expedition.
                </p>
            </div>
            <div class="image-container2">
                <img class="img2" src="image4.jpeg" class="homepage2">
            </div>
            <div class="paragraph-container2">
                <p class="advantagesofblogging2" style="font-size: 20px;">
                    At Addition, our mission goes beyond words; it's about action. We provide the tools, resources, and support needed for knowledge-seekers, creators, and explorers to thrive. 
                    Whether you're an aspiring writer, a seasoned expert, or simply someone eager to explore new horizons, we're here to fuel your journey. 
                    Our platform is designed to foster collaboration, spark creativity, and ignite intellectual conversations that transcend borders. We believe that by sharing knowledge, we can collectively shape a brighter future. 
                    Together, let's break down the barriers to learning and discovery, making the world a place where information knows no bounds. 
                    Join us in our quest to empower minds and make knowledge accessible to all.
                </p>
            </div>
        </div>
        
        <div class="footer">
            <p>Contact us: Phone: +962 778656985 | Email: 21210006@htu.edu.jo</p>
        </div>
        <div class="profile-popup" id="profilePopup">
            <h5>Profile Menu</h5>
            <ul>
                <li><a href="Profile.php">Profile</a></li>
                <li><a href="Login.php">Login</a></li>
                <li><a href="Logout.php">Logout</a></li>
            </ul>
        </div>
    </div>    
    <script>
        // Get a reference to the profile popup element
        const profilePopup = document.getElementById("profilePopup");

        // Function to toggle the visibility of the profile popup
        function toggleProfilePopup() {
            // Check if the profile popup is currently hidden or has no defined display style
            if (profilePopup.style.display === "none" || profilePopup.style.display === "") {
                // If hidden or no defined display style, show the profile popup
                profilePopup.style.display = "block";
            } else {
                // If already displayed, hide the profile popup
                profilePopup.style.display = "none";
            }
        }

        // Close the profile popup if the user clicks outside of it
        window.addEventListener("click", function(event) {
            // Check if the click event target is not the profile popup itself
            // and not within the profile popup, and not the user logo element
            if (event.target !== profilePopup && !profilePopup.contains(event.target) && event.target !== document.querySelector('.user-logo')) {
                // If the click is outside, hide the profile popup
                profilePopup.style.display = "none";
            }
        });
    </script>
</body>
</html>