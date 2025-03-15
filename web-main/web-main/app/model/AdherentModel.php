<?php
require_once 'C:\xampp\htdocs\web-main\web-main\app\core\database.php';

class AdherentModel {
    private $conn;
    private $table_name = "adherents";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function postuler($user_id, $club_id, $cv) {
        $query = "INSERT INTO " . $this->table_name . " (user_id, club_id, cv) 
                  VALUES (:user_id, :club_id, :cv)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindParam(":club_id", $club_id);
        $stmt->bindParam(":cv", $cv);
        return $stmt->execute();
    }

    public function getDemandes() {
        $query = "SELECT a.id, u.nom, c.nom as club, a.cv, a.statut 
                  FROM " . $this->table_name . " a
                  JOIN users u ON a.user_id = u.id
                  JOIN clubs c ON a.club_id = c.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ✅ Mettre à jour le statut d'un adhérent
    public function updateStatut($id, $statut) {
        $query = "UPDATE " . $this->table_name . " SET statut = :statut WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":statut", $statut);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
?>
