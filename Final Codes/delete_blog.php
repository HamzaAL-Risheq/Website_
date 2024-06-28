<?php
session_start();
require("Connect.php"); // Make sure this line is correct

try {
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the user is authorized to delete the blog (you can customize this part)
    $userId = $_SESSION['ID']; // Assuming you store user's ID in the session
    $blogId = $_POST['id']; // Assuming you send the blog ID from JavaScript

    // Query to check if the user is the author of the blog 
    $checkQuery = $pdo->prepare("SELECT Client_ID FROM posted_blogs WHERE ID = :id");
    $checkQuery->bindParam(":id",$blogId,PDO::PARAM_STR);
    $checkQuery->execute();
    // It return the vaule of the client id.
    $row = $checkQuery->fetch(PDO::FETCH_ASSOC);

    if ($row && $row['Client_ID'] == $userId) {
        // User is authorized to delete the blog
        $deleteQuery = $pdo->prepare("DELETE FROM posted_blogs WHERE ID = ?");
        $deleteQuery->execute([$blogId]);

        // Respond with success message
        echo json_encode(['success' => true]);
    } else {
        // User is not authorized to delete the blog
        echo json_encode(['error' => 'Unauthorized']);
    }
} catch (PDOException $e) {
    // Handle any database errors here
    echo json_encode(['error' => $e->getMessage()]);
}
?>
