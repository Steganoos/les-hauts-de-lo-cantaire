<?php
// index.php

// Chargement des contrôleurs
require_once 'src/controllers/Homepage.php';
require_once 'src/controllers/ProductId.php';
require_once 'src/controllers/JoinUs.php';
require_once 'src/controllers/Contact.php';
require_once 'src/controllers/NotFound.php';
require_once 'src/controllers/LoginPageController.php';
require_once 'src/controllers/AuthController.php';
require_once 'src/controllers/AdminDashboardController.php';

define('BASE_URL', '/les_hauts_de_lo_cantaire/');

// Récupération de la page demandée (ou 'homepage' par défaut)
$page = $_GET['page'] ?? 'homepage';


switch ($page) {
    case 'homepage':
        (new Homepage())->execute();
        break;

    case 'product':
    // On récupère l'identifiant passé dans l'URL (GET), et on valide qu'il s'agit bien d'un entier
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    // Si l'ID n'est pas valide on redirige vers une page d'erreur
    if ($id === false || $id <= 0) {
        (new NotFound())->execute(); // Exécute le contrôleur de page non trouvée
        break;
    }

    // Si l'ID est valide, on instancie le contrôleur correspondant et on lui passe l'ID pour afficher les détails du produit
    (new ProductId())->execute($id);
    break;        
    
    case 'joinUs':
        (new JoinUs())->execute();
        break;

    case 'contact':
        (new Contact())->execute();
        break;

    case 'loginPage':
        (new LoginPageController())->showLoginForm();
        break;
        
    case 'authController':
        (new AuthController())->auth();
        break;

    case 'adminDashboard':
        (new AdminDashboardController())->execute();
        break;
       
    case 'logout':
        session_unset();
        session_destroy();
        header("Location: index.php?page=login");
        break;

    default:
        (new NotFound())->execute();
        break;
}
