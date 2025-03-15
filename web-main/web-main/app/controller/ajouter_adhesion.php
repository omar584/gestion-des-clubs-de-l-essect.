<?php
require_once '\xampp\htdocs\web-main\web-main\app\controller\ajouter_adhesion.php'; // Ajuste le chemin selon ton projet

// Activer l'affichage des erreurs pour debug
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérification des champs
    if (!empty($_POST['nom']) && !empty($_POST['email']) && !empty($_POST['club_id'])) {
        $nom = htmlspecialchars($_POST['nom']);
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        $club_id = intval($_POST['club_id']);

        if ($email) {
            try {
                $db = new Database();
                $conn = $db->getConnection();

                $query = "INSERT INTO adhesions (nom, email, club_id) VALUES (:nom, :email, :club_id)";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':nom', $nom);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':club_id', $club_id);

                if ($stmt->execute()) {
                    // ✅ Redirection vers confirmation.php après succès
                    header("Location: ../../public/confirmation.php");
                    exit();
                } else {
                    echo "❌ Erreur lors de l'inscription.";
                }
            } catch (PDOException $e) {
                echo "❌ Erreur de base de données : " . $e->getMessage();
            }
        } else {
            echo "⚠️ Email invalide.";
        }
    } else {
        echo "⚠️ Tous les champs sont obligatoires.";
    }
} else {
    echo "⚠️ Méthode non autorisée.";
}
?>
