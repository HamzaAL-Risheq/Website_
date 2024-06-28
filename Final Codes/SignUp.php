<?php
// Include the Connect.php file that establishes a database connection

require("Connect.php");

// Check if the HTTP request method is POST, indicating a form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve user input from the registration form
    $FirstName = $_POST['FirstName'];
    $LastName = $_POST['LastName'];
    $Username = $_POST['Username'];
    $Email = $_POST['Email'];
    $Password = $_POST['Password'];

    try {
        // Check if the username already exists in the database
        $checkSql = "SELECT Username FROM client_info WHERE Username = :Username";
        $checkStatement = $pdo->prepare($checkSql);
        $checkStatement->bindParam(":Username", $Username, PDO::PARAM_STR);
        $checkStatement->execute();

        if ($checkStatement->rowCount() > 0) {
            // Username already exists, display an error message
            echo "Username already exists. Please choose a different username.";
        } else {
            // Username is unique, proceed with user registration

            // SQL statement to insert user data into the database
            $sql = "INSERT INTO client_info (FirstName, LastName, Username, Email, Password) VALUES (:FirstName, :LastName, :Username, :Email, :Password)";
            $statement = $pdo->prepare($sql);
            
            // Bind user data to prepared statement parameters
            $statement->bindParam(":FirstName", $FirstName, PDO::PARAM_STR);
            $statement->bindParam(":LastName", $LastName, PDO::PARAM_STR);
            $statement->bindParam(":Username", $Username, PDO::PARAM_STR);
            $statement->bindParam(":Email", $Email, PDO::PARAM_STR);
            $statement->bindParam(":Password", $Password, PDO::PARAM_STR);

            // Execute the SQL statement to insert the user data
            $statement->execute();

            // Registration successful, you can redirect the user to the login page
            header("location:Login.php");
        }
    } catch (PDOException $e) {
        // Handle any database-related exceptions and display an error message
        echo "Error: " . $e->getMessage();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Sign up page </title>
    <link rel="stylesheet" href="SignUpStyleSheet.css">
</head>
<body>
    <div class = "Main-Container">
        <img class="img1" src = "Myproject.jpeg"  alt ="SignUpImage">
        <h1> Sign up </h1>
        <form action = "" method = "POST"> 
               
            <label for ='FirstName'> First Name </label> 
            <input type = 'text' id= 'FirstName' name = 'FirstName' placeholder = 'Enter your FirstName' required> <br>

            <label for ='LastName'> Last Name </label> 
            <input type = 'text' id= 'LastName' name = 'LastName' placeholder = 'Enter yout LastName' required> <br>
    
            <label for ='Username'> User Name </label> 
            <input type = 'text' id= 'UserName' name = 'Username' placeholder = 'Enter your UserName' required> <br>
    
            <label for='Email'> Email </label> 
            <input type='email' id='EmailAddress' name='Email' placeholder='Enter your Email here' required> <br>
    
            <label for='Password'>  Password </label>
            <input type = 'password' id= 'Password' name = 'Password' placeholder = 'Enter your Password here' required>

            <button type="submit"> Signup </button>
        </form> 
    </div>    
</body>
</html>