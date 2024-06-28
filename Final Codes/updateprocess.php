<?php
session_start();
require("Connect.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $blogId = $_POST['blog_id'];
    $userId = $_SESSION['Client_ID'];
    $newContent = $_POST['content'];

    // Check if the user is authorized to update the blog post
    $stmt = $pdo->prepare("SELECT * FROM posted_blogs WHERE ID = :id AND Client_ID = :user_id");
    $stmt->bindParam(":id", $blogId);
    $stmt->bindParam(":user_id", $userId);
    $stmt->execute();

    if ($stmt->rowCount() == 0) {
        // User is not authorized to update this blog post, show an error message
        echo "You are not authorized to update this blog post.";
        exit;
    }

    // Update the blog post content in the database
    $updateStmt = $pdo->prepare("UPDATE posted_blogs SET Content = :content WHERE ID = :id");
    $updateStmt->bindParam(":content", $newContent);
    $updateStmt->bindParam(":id", $blogId);
    $updateStmt->execute();

    // Redirect back to the main page or the edited blog post
    header("Location: PostedBlogs.php");
    exit;
} else {
    echo "Invalid request.";
}
?>
