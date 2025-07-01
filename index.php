<?php
// index.php

// Chargement des contrôleurs
require_once __DIR__ . '/src/controllers/Homepage.php';
require_once __DIR__ . '/src/controllers/ProductId.php';
require_once __DIR__ . '/src/controllers/JoinUs.php';
require_once __DIR__ . '/src/controllers/Contact.php';
require_once __DIR__ . '/src/controllers/NotFound.php';
require_once __DIR__ . '/src/controllers/LoginPageController.php';
require_once __DIR__ . '/src/controllers/AuthController.php';
require_once __DIR__ . '/src/controllers/AdminDashboardController.php';
require_once __DIR__ . '/src/controllers/AdminProductsManagementController.php';
require_once __DIR__ . '/src/controllers/AdminEventsManagementController.php';
require_once __DIR__ . '/src/controllers/AdminEditEventController.php';
require_once __DIR__ . '/src/controllers/AdminUpdateEventController.php';
require_once __DIR__ . '/src/controllers/AdminNewEventPageController.php';
require_once __DIR__ . '/src/controllers/AdminAddNewEventController.php';
require_once __DIR__ . '/src/controllers/AdminDeleteEventController.php';
require_once __DIR__ . '/src/controllers/LogoutController.php';
require_once __DIR__ . '/src/controllers/LegalController.php';


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
        if ($id === false || $id <= 0)
        {
        (new NotFound())->execute(); // Exécute le contrôleur de page non trouvée
        break;
        }

        // Si l'ID est valide, on instancie le contrôleur correspondant et on lui passe l'ID pour afficher les détails du produit
        (new ProductId())->execute($id);
        break;        
    
    case 'join-us':
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

    case 'products-management':
        (new AdminProductsManagementController())->execute();
    break; 
    
        case 'events-management':
        (new AdminEventsManagementController())->execute();
    break; 

    case 'edit-event':
        // On récupère l'identifiant passé dans l'URL (GET), et on valide qu'il s'agit bien d'un entier
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        // Si l'ID n'est pas valide on redirige vers une page d'erreur
        if ($id === false || $id <= 0)
        {
            (new NotFound())->execute(); // Exécute le contrôleur de page non trouvée
            break;
        }
            // Si l'ID est valide, on instancie le contrôleur correspondant et on lui passe l'ID pour afficher les détails du produit
            (new AdminEditEventController())->execute($id);
            break;

    case 'update-event':
        // On récupère l'identifiant passé dans l'URL (GET), et on valide qu'il s'agit bien d'un entier
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        // Si l'ID n'est pas valide on redirige vers une page d'erreur
        if ($id === false || $id <= 0)
         {
            (new NotFound())->execute(); // Exécute le contrôleur de page non trouvée
            break;
        }
            // Si l'ID est valide, on instancie le contrôleur correspondant et on lui passe l'ID pour afficher les détails du produit
            (new AdminUpdateEventController())->execute($id);
            break;        
       
    case 'new-event-page':
        (new AdminNewEventPageController())->execute();
        break;
       
    case 'add-new-event':
        (new AdminAddNewEventController())->execute();
        break;
       
    case 'delete-event':
         // On récupère l'identifiant passé dans l'URL (GET), et on valide qu'il s'agit bien d'un entier
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        // Si l'ID n'est pas valide on redirige vers une page d'erreur
        if ($id === false || $id <= 0)
         {
            (new NotFound())->execute(); // Exécute le contrôleur de page non trouvée
            break;
        }
        (new AdminDeleteEventController())->execute($id);
        break;
       
    case 'logout':
        (new LogoutController())->execute();
        break;

    case 'legal':
        (new LegalController())->execute();
        break;

    default:
        (new NotFound())->execute();
        break;
}

