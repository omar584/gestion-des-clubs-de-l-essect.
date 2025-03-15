<?php
    require_once "../app/controller/UserController.php";
    require_once "../app/controller/ClubController.php";
    require_once "../app/controller/AdherentController.php";
    // Vérifier si 'action' est défini dans l'URL, sinon charger la page d'accueil
    $action = isset($_GET['action']) ? $_GET['action'] : 'home';

    switch($action){
        case 'registre':
            $a = new UserController;
            $a->register();  
            break;
        
        case 'login': 
            $a = new UserController;
            $a->login();  
            break;

        case 'clubs':
            require_once "../app/view/clubs.php";
            break;
        case 'log':
            require_once "../app/view/login.php";
            break;
        case 'reg':
             require_once "../app/view/register.php";
             break;
        case 'dash':
             require_once "../app/view/dashbord.php";
             break;
            
            
             
            
        case 'home': // Page d'accueil par défaut
        default:
            require_once "../app/view/home.php"; // Assure-toi que le chemin est correct
            break;
    }
?>
