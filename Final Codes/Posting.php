<?php
session_start();
if (!isset($_SESSION['access'])) {
    header("location: Login.php");
}
require("connect.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the Client_ID based on the logged-in user
    $username = $_SESSION['access'];
    $getClientIdSql = "SELECT ID FROM client_info WHERE Username = :username";
    $getClientIdStmt = $pdo->prepare($getClientIdSql);
    $getClientIdStmt->bindParam(":username", $username, PDO::PARAM_STR);
    $getClientIdStmt->execute();
    $result = $getClientIdStmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $clientID = $result['ID'];
        $content = $_POST['textbox']; // Make sure 'textbox' matches your form field name

        $insertSql = "INSERT INTO posted_blogs (Content, Client_ID) VALUES (:content, :clientID)";
        $insertStmt = $pdo->prepare($insertSql);
        $insertStmt->bindParam(":content", $content, PDO::PARAM_STR);
        $insertStmt->bindParam(":clientID", $clientID, PDO::PARAM_INT);

        if ($insertStmt->execute()) {
           // header("Location: home.php");
             // Ensure script execution stops after redirect
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ask for Help Page</title>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="PostingStyleSheet.css">
</head>
<body>
    <div class="header">
        <div class="logo-container">
            <a href ='./Home_Page.html'>
                <img class="company-logo" src="2.jpeg" alt="Company Logo" >
            </a>
            <div class="company-name">Addition</div>
            <i class="user-logo fas fa-user" onclick="toggleProfilePopup()"></i>

        </div>
    </div>
    <div class="navbar">
        <div class="navbar-left">
            <ul>
                <li><a href="#" class = "AboutUs">About Us</a></li>
                <li><a class = "Askforhelp" href="./Home_Page.html" ><i class="fa fa-home"></i>Home</a></li>
                <li><a class = "Blogs" href="./Blogs_Page.html"><i class="fas fa-address-book"></i>Blogs</a></li>
            </ul>
        </div>
        <div class="navbar-right">
            <!-- Search Bar -->
            <div class="search-bar">
            <input type="text" class="search-input" id="search" placeholder="Search...">
                <button class="search-button" type="button"><i class="fas fa-search search-icon"></i></button>
            </div>
        </div>
    </div> 
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <textarea name="textbox" class="textbox" placeholder="Add to This world!"></textarea>
        <button class="textboxButton" type="submit" name ="Content">    Add to This world! </button>
    </form>
    <div class="footer">
        <p>Contact us: Phone: +962 778656985 | Email: 21210006@htu.edu.jo</p>
    </div>
    </div> 
        <div class="profile-popup" id="profilePopup">
        <h5>Profile Menu</h5>
        <ul>
            <li><a href="#">Profile</a></li>
            <li><a href="logout.php"> Log out</a></li>
        </ul>
    </div>
    <script>
        // Get a reference to the profile popup element
        const profilePopup = document.getElementById("profilePopup");

        // Function to toggle the visibility of the profile popup
        // Function to toggle the visibility of the profile popup
        function toggleProfilePopup() {
            const profilePopup = document.getElementById("profilePopup");
            if (profilePopup.style.display === "none" || profilePopup.style.display === "") {
                profilePopup.style.display = "block";
            } else {
                profilePopup.style.display = "none";
            }
        }

        // Close the profile popup if the user clicks outside of it
        window.addEventListener("click", function(event) {
            if (event.target !== profilePopup && !profilePopup.contains(event.target) && event.target !== document.querySelector('.user-logo')) {
                profilePopup.style.display = "none";
            }   
        });

        


    </script>
</body>
</html>