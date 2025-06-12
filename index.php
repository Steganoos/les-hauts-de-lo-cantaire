<?php
// index.php

// Chargement des contrôleurs
require_once 'src/controllers/Homepage.php';
require_once 'controllers/Product.php';
require_once 'src/controllers/JoinUs.php';
require_once 'src/controllers/Contact.php';
require_once 'src/controllers/NotFound.php';

// Récupération de la page demandée (ou 'homepage' par défaut)
$page = $_GET['page'] ?? 'homepage';

switch ($page) {
    case 'homepage':
        (new Homepage())->execute();
        break;

    case 'product':
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    if ($id === false || $id <= 0) {
        (new NotFound())->execute();
        break;
    }
    // Appel du contrôleur avec ID valide
    (new Product())->execute($id);
    break;
        
    
    case 'joinUs':
        (new JoinUs())->execute();
        break;

    case 'contact':
        (new Contact())->execute();
        break;

    default:
        (new NotFound())->execute();
        break;
}
