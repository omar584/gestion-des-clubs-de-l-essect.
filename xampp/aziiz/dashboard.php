<?php
session_start();
require 'db.php';

// Vérification si l'utilisateur est admin
if ($_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

// Récupération des statistiques des clubs
$stmt = $pdo->query("
    SELECT 
        clubs.nom, 
        COUNT(requests.id) AS total_demandes 
    FROM clubs 
    LEFT JOIN requests ON clubs.id = requests.club_id 
    GROUP BY clubs.nom
");
$stats = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Statistiques des clubs 📊</h1>
    
    <table id="statsTable" class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Nom du club</th>
                <th>Nombre de demandes d'adhésion</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($stats as $stat): ?>
                <tr>
                    <td><?= $stat['nom'] ?></td>
                    <td><?= $stat['total_demandes'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Scripts JS pour Bootstrap et DataTables -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<!-- Activation de DataTables -->
<script>
    $(document).ready(function() {
        $('#statsTable').DataTable({
            "paging": true,
            "ordering": true,
            "info": true,
            "searching": true,
            "language": {
                "lengthMenu": "Afficher _MENU_ clubs par page",
                "zeroRecords": "Aucun club trouvé",
                "info": "Page _PAGE_ sur _PAGES_",
                "infoEmpty": "Aucune donnée disponible",
                "infoFiltered": "(filtré sur _MAX_ clubs)",
                "search": "Rechercher :",
                "paginate": {
                    "first": "Premier",
                    "last": "Dernier",
                    "next": "Suivant",
                    "previous": "Précédent"
                }
            }
        });
    });
</script>
</body>
</html>
