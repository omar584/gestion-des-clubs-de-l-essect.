<?php
require_once 'C:\xampp\htdocs\web-main\web-main\app\model\AdherentModel.php';
class AdherentController {
    private $adherentModel;

    public function __construct() {
        $this->adherentModel = new AdherentModel();
        session_start();
    }

    public function postuler() {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["cv"])) {
            $user_id = $_SESSION["user"]["id"];
            $club_id = $_POST["club_id"];
            $cv_name = time() . "_" . $_FILES["cv"]["name"];
            $cv_path = "../../uploads/" . $cv_name;

            if (move_uploaded_file($_FILES["cv"]["tmp_name"], $cv_path)) {
                if ($this->adherentModel->postuler($user_id, $club_id, $cv_name)) {
                    header("Location: clubs.php?success=1");
                    exit();
                } else {
                    echo "Erreur lors de l’envoi de la demande.";
                }
            } else {
                echo "Erreur lors du téléchargement du CV.";
            }
        }
    }
}
?>
