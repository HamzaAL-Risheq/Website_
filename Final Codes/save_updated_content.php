// save_updated_content.php
<?php
session_start();
require("Connect.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["id"];
    $content = $_POST["content"];

    try {
        $stmt = $pdo->prepare("UPDATE posted_blogs SET Content = :content WHERE ID = :id");
        $stmt->bindParam(":content", $content, PDO::PARAM_STR);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        // Optionally, you can send a success response back to the client
        echo json_encode(["message" => "Content updated successfully"]);
    } catch (PDOException $e) {
        // Handle errors
        echo json_encode(["error" => $e->getMessage()]);
    }
}
?>
