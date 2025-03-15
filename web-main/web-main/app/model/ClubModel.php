<?php
require_once 'C:\xampp\htdocs\web-main\web-main\app\core\database.php';

class ClubModel {
    private $conn;
    private $table_name = "clubs";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAllClubs() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addClub($nom, $description, $date_creation, $facebook, $instagram, $imagePath) {
        // Vérification des entrées (évite d'insérer des valeurs nulles)
        if (empty($nom) || empty($description) || empty($date_creation)) {
            return false;
        }

        $query = "INSERT INTO " . $this->table_name . " (nom, description, date_creation, lien_facebook, lien_instagram, image) 
                  VALUES (:nom, :description, :date_creation, :facebook, :instagram, :image)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":nom", $nom);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":date_creation", $date_creation);
        $stmt->bindParam(":facebook", $facebook);
        $stmt->bindParam(":instagram", $instagram);
        $stmt->bindParam(":image", $imagePath);

        return $stmt->execute();
    }
}
?>
