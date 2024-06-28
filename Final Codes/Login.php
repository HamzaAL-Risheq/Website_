<?php
// Start a new or resume the existing session
session_start();

// Include the Connect.php file to establish a database connection
require("Connect.php");

// Check if the login form has been submitted
if(isset($_POST['Log_in'])){
    // Define the SQL query to select the user by matching the provided username and password
    $sql = "SELECT ID, Username, Password FROM client_info WHERE Username=:Username AND Password=:Password";

    // Prepare the SQL statement
    $statement = $pdo->prepare($sql);

    // Retrieve the username and password submitted in the form
    $Username = $_POST['Username'];
    $Password = $_POST['Password'];

    // Bind the retrieved username and password as parameters in the prepared statement
    $statement->bindParam(":Username", $Username, PDO::PARAM_STR);
    $statement->bindParam(":Password", $Password, PDO::PARAM_STR);

    // Execute the SQL statement
    $statement->execute();
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        // Store user data in variables
        $ID = $row["ID"];
    } 

    // Get the number of rows returned by the query
    $count = $statement->rowCount();

    // Check if a matching user was found (count is 1)
    if($count == 1) {
        // Store the username in the session to track the user's login status
        $_SESSION['access'] = $Username;
        $_SESSION['ID'] = $ID;

        // Set a privilege flag to indicate that the user is logged in
        $_SESSION['privilged'] = true;

        // Redirect the user to the index.php page (after successful login)
        header("location:index.php");
    } else {
        // Display an error message for invalid username or password
        echo "<script>alert('Invalid username or password');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login Page</title>
        <link rel="stylesheet" href="Login_Stylesheet.css">
</head> 
    <body>   
        <div class = 'container'>
            <h1> Login </h1> 
            <form method="POST" >
                <label for ='Username'> Username </label> <br>
                <input type="text" id="Username" name="Username" placeholder="Enter your Username here" required> 
        
                <label for='Password' id='PasswordLabel'>  Password </label> 
                <input type="password" id="Password" name="Password" placeholder="Enter your Password here" required>

                <button id="button" type="submit" name="Log_in" style="width: 100%;">Login</button>

              
                
            </form>   
            <h2> 
                <a href='SignUp.php'> Don't have an account? Sign up </a>
            </h2>
        </div>    
    </body>
</html>