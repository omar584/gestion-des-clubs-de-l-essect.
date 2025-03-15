<?php 
require_once 'C:\xampp\htdocs\web-main\web-main\app\controller\ajouter_adhesion.php';

class DashboardModel {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getTotalClubs() {
        $query = "SELECT COUNT(*) AS total FROM clubs";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function getTotalAdhesions() {
        try {
            $query = "SELECT COUNT(*) AS total FROM adhesions";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
        } catch (PDOException $e) {
            return "Erreur: " . $e->getMessage();
        }
    }

    public function getTopClubs() {
        $query = "SELECT clubs.nom, COUNT(adhesions.id) AS nb_adhesions 
                  FROM clubs
                  LEFT JOIN adhesions ON clubs.id = adhesions.club_id
                  GROUP BY clubs.id
                  ORDER BY nb_adhesions DESC
                  LIMIT 5";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

$dashboard = new DashboardModel();
$totalClubs = $dashboard->getTotalClubs();
$totalAdhesions = $dashboard->getTotalAdhesions();
$topClubs = $dashboard->getTopClubs();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">📊 Tableau de Bord</h2>
    
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5>Total Clubs</h5>
                    <h2><?= htmlspecialchars($totalClubs) ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5>Total Adhésions</h5>
                    <h2><?= htmlspecialchars($totalAdhesions) ?></h2>
                </div>
            </div>
        </div>
    </div>

    <h3 class="mt-5">🏆 Top 2 Clubs les plus populaires</h3>
    <table class="table table-bordered mt-3">
        <thead class="table-dark">
            <tr>
                <th>Nom du Club</th>
                <th>Nombre d'Adhésions</th>
                <th>Logo</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($topClubs as $club): ?>
                <tr>
                    <td><?= htmlspecialchars($club['nom']) ?></td>
                    <td><?= htmlspecialchars($club['nb_adhesions']) ?></td>
                    <td>
                        <img src="../public/upload/<?= strtolower(str_replace(' ', '_', $club['nom'])) ?>.jpg" alt="Logo <?= htmlspecialchars($club['nom']) ?>" width="50">
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <form action=/web-main/app/controllers/ajouter_adhesion.php" method="post">
" method="post" class="mt-4">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom :</label>
            <input type="text" name="nom" id="nom" class="form-control" required>
        </div>
        
        <div class="mb-3">
            <label for="email" class="form-label">Email :</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="club_id" class="form-label">Choisir un club :</label>
            <select name="club_id" id="club_id" class="form-control" required>
                <?php
                $db = new Database();
                $conn = $db->getConnection();
                $stmt = $conn->query("SELECT id, nom FROM clubs");
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='{$row['id']}'>{$row['nom']}</option>";
                }
                ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">S'inscrire</button>
    </form>
</div>
</body>
</html>
