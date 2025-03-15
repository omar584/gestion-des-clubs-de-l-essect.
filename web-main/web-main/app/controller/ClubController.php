<?php
require_once 'C:\xampp\htdocs\web-main\web-main\app\model\ClubModel.php';

class ClubController {
    private $clubModel;

    public function __construct() {
        $this->clubModel = new ClubModel();
    }

    public function afficherClubs() {
        return $this->clubModel->getAllClubs();
    }

    public function ajouterClub() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nom = $_POST["nom"];
            $description = $_POST["description"];
            $date_creation = $_POST["date_creation"];
            $facebook = $_POST["facebook"];
            $instagram = $_POST["instagram"];

            if ($this->clubModel->addClub($nom, $description, $date_creation, $facebook, $instagram)) {
                header("Location: clubs.php?success=1");
                exit();
            } else {
                echo "Erreur lors de l'ajout du club.";
            }
        }
    }
}
?>
