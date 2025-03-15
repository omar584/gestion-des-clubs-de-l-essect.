<?php
require_once 'C:\xampp\htdocs\web-main\web-main\app\model\UserModel.php';

session_start();

class UserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function register() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nom = $_POST["nom"];
            $email = $_POST["email"];
            $password = $_POST["password"];

            if ($this->userModel->register($nom, $email, $password)) {
                header("Location: index.php?action=log");
                exit();
            } else {
                echo "Erreur lors de l'inscription.";
            }
        }
    }

    public function login() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST["email"];
            $password = $_POST["password"];
            $user = $this->userModel->login($email, $password);

            if ($user) {
                $_SESSION["user"] = $user;
                header("Location: index.php?action=dash");
                exit();
            } else {
                echo "Identifiants incorrects.";
            }
        }
    }

    public function logout() {
        session_destroy();
        header("Location: login.php");
        exit();
    }
}
?>
