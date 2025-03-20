<?php 
require_once 'C:\xampp\htdocs\web-main\web-main\app\controller\ClubController.php'; 
require_once 'C:\xampp\htdocs\web-main\web-main\app\controller\AdherentController.php'; 

$clubController = new ClubController();
$clubs = $clubController->afficherClubs();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Clubs</title>
    <link rel="stylesheet" href="../public/assets/style.css">
    <link rel="stylesheet" href="../public/assets/club.css">
</head>
<body>
    <h2>Liste des clubs</h2>
    
    <?php foreach ($clubs as $club) : ?>
        <div>
            <h3><?= htmlspecialchars($club["nom"]) ?></h3>
            <p><?= htmlspecialchars($club["description"]) ?></p>
            <p>Créé le: <?= htmlspecialchars($club["date_creation"]) ?></p>
            
            <!-- Affichage de l'image avec chemin correct -->
            <?php 
            $imagePath = "../public/upload/" . basename($club["image"]); 
            ?>
            <img src="<?= htmlspecialchars($imagePath) ?>" 
                 alt="Logo <?= htmlspecialchars($club["nom"]) ?>" 
                 width="200">

            <p>
                <a href="<?= htmlspecialchars($club["lien_facebook"]) ?>" target="_blank">Facebook</a> | 
                <a href="<?= htmlspecialchars($club["lien_instagram"]) ?>" target="_blank">Instagram</a>
            </p>

            <!-- Bouton pour voir les membres -->
            <form action="index.php?action=vb" method="GET">
                <input type="hidden" name="club_id" value="<?= $club["id"] ?>">
                <button type="submit">Voir le burreau</button>
            </form>

            <!-- Formulaire de postulation -->
            <form action="../public/index.php?action=postuler" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="club_id" value="<?= $club["id"] ?>">
                <input type="file" name="cv" required>
                <button type="submit">Postuler</button>
            </form>
        </div>
        <hr>
    <?php endforeach; ?>

</body>
</html>
