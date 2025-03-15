<?php
$host = 'localhost';
$dbname = 'club_management';
$username = 'root'; // Modifier selon votre config
$password = ''; // Modifier selon votre config

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données: " . $e->getMessage());
}
?>
