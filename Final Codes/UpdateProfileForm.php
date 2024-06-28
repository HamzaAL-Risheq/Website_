<?php
session_start();
require("Connect.php");
$ID = $_SESSION['ID'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $updatedFirstName = $_POST["FirstName"];
    $updatedLastName = $_POST["LastName"];
    $updatedUsername = $_POST["Username"];
    $updatedEmail = $_POST["Email"];
    $updatedPassword = $_POST["Password"];
    $CV_LINK = $_POST["CV_link"];
    
    try {
        // Check if the username already exists
        $checkSql = "SELECT Username FROM client_info WHERE ID = :ID";
        $checkStatement = $pdo->prepare($checkSql);
        $checkStatement->bindParam(":ID", $ID, PDO::PARAM_STR);
        $checkStatement->execute();
    
        if ($checkStatement->rowCount() > 0) {
            // Username already exists, handle this case (e.g., show an error message)
            
            // Username is unique, proceed with the update
            $sql = "UPDATE client_info SET FirstName = :FirstName, LastName = :LastName, Username = :UpdatedUsername, Email = :Email, CVLink = :CVLink, Password = :UpdatedPassword WHERE ID = :ID";
            $statement = $pdo->prepare($sql);
            $statement->bindParam(":FirstName", $updatedFirstName, PDO::PARAM_STR);
            $statement->bindParam(":LastName", $updatedLastName, PDO::PARAM_STR);
            $statement->bindParam(":UpdatedUsername", $updatedUsername, PDO::PARAM_STR);
            $statement->bindParam(":Email", $updatedEmail, PDO::PARAM_STR);
            $statement->bindParam(":CVLink", $CV_LINK, PDO::PARAM_STR);
            $statement->bindParam(":UpdatedPassword", $updatedPassword, PDO::PARAM_STR);
            $statement->bindParam(":ID", $ID, PDO::PARAM_INT);
            $statement->execute();
            $_SESSION['access'] = $updatedUsername; 
        }


        header("location:Profile.php");
    } catch (PDOException $e) {
        // Handle the database exception
        echo "Error: " . $e->getMessage();
    }
}
?>
