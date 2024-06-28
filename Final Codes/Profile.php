<?php
// Start a new session or resume the existing session
session_start();

// Check if the user is not privileged (not logged in)
if (!isset($_SESSION['privilged'])) {
    // Redirect the user to the login page
    header("location: Login.php");
}

// Include the database connection file
require("Connect.php");

// Get the username from the session
$Username = $_SESSION['access'];

// SQL query to retrieve user data based on the username
$sql = "SELECT ID, FirstName, LastName, Username, Email, Password FROM client_info WHERE Username = :Username";

try {
    // Prepare and execute the SQL query
    $result = $pdo->prepare($sql);
    $result->bindParam(":Username", $Username, PDO::PARAM_STR);
    $result->execute();

    // Check if the query returned a row (user found)
    $row = $result->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        // Store user data in variables
        $ID = $row["ID"];
        $firstName = $row["FirstName"];
        $lastName = $row["LastName"];
        $username = $row["Username"];
        $email = $row["Email"];
        $password = $row["Password"];

        // Store the user's ID in the session for later use
        $_SESSION["ID"] = $ID;
    } else {
        echo "No user found with the given ID.";
    }

    // Close the database connection
} catch (PDOException $e) {
    // Handle any database exceptions that occur
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Profile </title>
    <link rel="stylesheet" href="ProfileStyleSheet.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<style>
    .square {
        grid-row-start: 1;
        height: 27%;
        width: 15%;
        background-color: #555;
        position: absolute;
        top: 20.5%;
    }
    .save{
        text-emphasis-color:#1E2126 ;
        width: 100%;;
        height: 35px;
        border-radius: 10px;
        background: #1E2126; 
        color: #9B8484;
        font-family: Tangerine;
        font-size: 20px;
        font-weight: 500;   
        grid-column-start: 0;
        grid-column-end: 1;
        position: relative;
        margin-top: 1%;
        left: 0%;
    }
    form {
        position: relative;
        bottom: -31%;
    }
    @media only screen and (max-width: 1200px) {
    .square {
        height: 22%;
        width: 50%;
    }
}

</style>
<body>
    <div class="container">
        <div class="header">
            <div class="logo-container">
                <a href ='index.php'>
                    <img class="company-logo" src="2.jpeg" alt="Company Logo">
                </a>
                <div class="company-name">Addition</div>
                <i class="user-logo fas fa-user" onclick="toggleProfilePopup()"></i>
            </div>
        </div>
        <div class="navbar">
            <div class="navbar-left">
                <ul>
                    <li><a href="AboutUs.php" class = "AboutUs">About Us</a></li>
                    <li><a href="index.php" class = "Askforhelp"><i class="fa fa-home"></i>Home</a></li>
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
        <div class="main-content">
            <div class="square"></div>
            <form action="UpdateProfileForm.php" method="POST">
                <label for='FirstName'> First Name </label> 
                <input type='text' id='FirstName' name='FirstName' value="<?php echo htmlspecialchars($firstName); ?>" > <br>

                <label for='LastName'> Last Name </label> 
                <input type='text' id='LastName' name='LastName'  value="<?php echo htmlspecialchars($lastName); ?>" > <br>

                <label for='Username'> User Name </label> 
                <input type='text' id='UserName' name='Username' value="<?php echo htmlspecialchars($username); ?>" > <br>

                <label for='Email'> Email </label> 
                <input type='email' id='EmailAddress' name='Email' value="<?php echo htmlspecialchars($email); ?>" > <br>

                <label for='Password'>  Password </label>
                <input type='password' id='Password' name='Password'  value="<?php echo htmlspecialchars($password); ?>" >

                <label for='CV_link'> CV link </label>
                <input type='link' id='CV_link' name='CV_link' placeholder='CV link'>

                <button type="submit" class = "save" name = "Save"> Save </button>

            </form>
        </div>
        <div class="footer">
            <p>Contact us: Phone: +962 778656985 | Email: 21210006@htu.edu.jo</p>
        </div>
        <div class="profile-popup" id="profilePopup">
            <h5>Profile Menu</h5>
            <ul>
                <li><a href="Logout.php">Logout</a></li>
            </ul>
        </div>
    </div>    
    <script>
        // Get a reference to the profile popup element
        const profilePopup = document.getElementById("profilePopup");
        // Function to toggle the visibility of the profile popup
        function toggleProfilePopup() {
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