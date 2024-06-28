<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <!-- Add meta description -->
    <meta name="description" content="Welcome to Addition - Your Source for Insightful Blogs! Explore a diverse collection of blogs on various topics,
     written by our talented community. Find answers to your questions, share your knowledge, and connect with like-minded individuals.">

    <!-- Add meta keywords -->
    <meta name="keywords" content="Blogs, Articles, Insights, Knowledge Sharing, Community, Topics, Authors, 
    Discussion, Ask for Help, Information, Advice, Expertise, Connect, Explore, Learning, Inspiration, Blogging Community">
    <!-- The robots meta tag provides directives to search engine robots (bots) about how to interact with this web page. -->
    <meta name="robots" content="index, follow">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="indexStyleSheet.css">
</head>
<style>
    .img1 {
        width: 90%; 
    }
</style>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="logo-container">
                <a href ='home.php'>
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
                    <li><a href="AboutUs.php" class = "AboutUs">About Us</a></li>
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
                <img class="img1" src="homepage1.avif" class="homepage1">
            </div>
            <div class="paragraph-container">
                <p class="advantagesofblogging1" style="font-size: 24px;">
                    "Blogging brings your ideas to life, boosts your online presence, and offers income opportunities. 
                    It's a fun way to connect, improve writing, and engage with a global audience."
                </p>
            </div>
            <div class="image-container2">
                <img class="img2" src="homepage2.jpeg" class="homepage2">
            </div>
            <div class="paragraph-container2">
                <p class="advantagesofblogging2" style="font-size: 24px;">
                    "Blogging enables you to share your expertise and passions with the world, 
                    establishing you as an authority in your niche. Let the wolrd knows who you are"
                </p>
            </div>
        </div>
        
        <div class="footer">
            <p>Contact us: Phone: +962 778656985 | Email: 21210006@htu.edu.jo</p>
        </div>
        <div class="profile-popup" id="profilePopup">
            <h5>Profile Menu</h5>
            <ul>
                <li><a href="Profile.php">profile</a></li>
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