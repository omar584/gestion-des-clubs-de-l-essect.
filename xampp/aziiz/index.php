<?php
require 'db.php';

$stmt = $pdo->query("SELECT * FROM clubs");
$clubs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Clubs ESSECT</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background: #f9f9f9;
        }
        .navbar {
            margin-bottom: 20px;
        }
        .card {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">ESSECT Clubs</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Connexion</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="register.php">Inscription</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <h1 class="mb-4 text-center">Bienvenue sur la plateforme des clubs ESSECT 🎓</h1>
    <div class="row">
        <?php foreach ($clubs as $club): ?>
            <div class="col-md-4">
                <div class="card">
                    <img src="<?= $club['logo'] ?>" class="card-img-top" alt="<?= $club['nom'] ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= $club['nom'] ?></h5>
                        <p class="card-text"><?= $club['description'] ?></p>
                        <p class="card-text"><small class="text-muted">Créé le : <?= $club['date_creation'] ?></small></p>
                        <a href="<?= $club['reseaux_sociaux'] ?>" class="btn btn-info" target="_blank">Voir sur les réseaux</a>
                        <a href="adhesion.php?club_id=<?= $club['id'] ?>" class="btn btn-primary">Postuler</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
