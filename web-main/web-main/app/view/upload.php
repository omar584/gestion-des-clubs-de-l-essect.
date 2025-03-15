<?php
require '../../config.php'; // Vérifie que le chemin est correct

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])) {
    $imageName = $_FILES["image"]["name"];
    $imageData = file_get_contents($_FILES["image"]["tmp_name"]);

    $stmt = $pdo->prepare("INSERT INTO images (name, image) VALUES (:name, :image)");
    $stmt->bindParam(':name', $imageName);
    $stmt->bindParam(':image', $imageData, PDO::PARAM_LOB);

    if ($stmt->execute()) {
        header("Location: upload.php?message=ok");
    } else {
        header("Location: upload.php?message=fail");
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload d'Images</title>
    <style>
        .alert { padding: 10px; margin: 10px 0; }
        .success { background-color: lightgreen; }
        .fail { background-color: lightcoral; }
        img { width: 200px; margin: 10px; }
    </style>
</head>
<body>

<h2>Upload une Image</h2>
<form action="" method="post" enctype="multipart/form-data">
    <input type="file" name="image" required>
    <button type="submit">Uploader</button>
</form>

<?php
if (isset($_GET["message"])) {
    echo $_GET["message"] == "ok" ? "<div class='alert success'>Image uploadée avec succès !</div>" 
                                  : "<div class='alert fail'>Échec de l'upload.</div>";
}
?>

<h2>Images Stockées</h2>
<?php
$stmt = $pdo->query("SELECT id, name FROM images");
while ($row = $stmt->fetch()) {
    echo "<div><img src='../../view.php?id=" . $row['id'] . "' alt='" . $row['name'] . "'></div>";
}
?>

</body>
</html>
