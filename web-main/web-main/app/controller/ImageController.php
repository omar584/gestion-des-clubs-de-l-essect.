<?php
require_once "../../config.php";

class ImageController {
    public function uploadImage() {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])) {
            global $pdo; 
            
            $imageName = $_FILES["image"]["name"];
            $imageData = file_get_contents($_FILES["image"]["tmp_name"]);

            $stmt = $pdo->prepare("INSERT INTO images (name, image) VALUES (:name, :image)");
            $stmt->bindParam(':name', $imageName);
            $stmt->bindParam(':image', $imageData, PDO::PARAM_LOB);

            if ($stmt->execute()) {
                header("Location: ../../index.php?action=upload&message=ok");
            } else {
                header("Location: ../../index.php?action=upload&message=fail");
            }
            exit;
        }
    }
}
?>
