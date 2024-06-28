<?php
    session_start();
    if(!isset($_SESSION['privilged'])){
        header("location:Login.php");
    }
    require("Connect.php");

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
          
        $client_ID = $_SESSION['ID'];
        
        $sql="INSERT INTO posted_blogs (content,Client_ID) values (:content,:client_ID)";
        $statement=$pdo->prepare($sql);
        $content=$_POST['textbox'];
        echo "($content)";   

        $statement->bindParam(":content",$content,PDO::PARAM_STR);
        $statement->bindParam(":client_ID",$client_ID,PDO::PARAM_STR);
        $statement->execute();

        header("location:PostedBlogs.php");
        $pdo=null;

    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posting</title>
    <link rel="stylesheet" href="ADDPOST.css">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    
        <div class="header">
            <div class="logo-container">
                <a href ='index.php'>
                    <img class="company-logo" src="2.jpeg" alt="Company Logo" >
                </a>
                <div class="company-name">Addition</div>
                <i class="user-logo fas fa-user"></i>
            </div>
        </div>
        <div class="navbar">
            <div class="navbar-left">
                <ul>
                    <li><a href="AboutUs.php" class = "AboutUs">About Us</a></li>
                    <li><a class = "Askforhelp" href="index.php" ><i class="fa fa-home"></i>Home</a></li>
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
            <form actio="" method = "POST">
                <textarea id="textbox" name="textbox" class="request-input" placeholder="Add to This world!"></textarea>
                <button class="textboxButton" type="submit"> Add to This world! </button>
            </form>
        <div class="footer">
            <p>Contact us: Phone: +962 778656985 | Email: 21210006@htu.edu.jo</p>
        </div>
  

</body>
</html>