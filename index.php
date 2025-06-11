<?php
// index.php

require_once 'src/controllers/Homepage.php';
require_once 'src/controllers/JoinUs.php';
require_once 'src/controllers/Contact.php';
require_once 'src/controllers/NotFound.php';

// Récupérer la page depuis l'URL (ou valeur par défaut)
$page = $_GET['page'] ?? 'homepage';

switch ($page) {
    case 'homepage':
        (new Homepage())->execute();
        break;

    case 'joinUs':
        (new JoinUs())->execute();
        break;

    case 'contact':
        (new Contact())->execute();
        break;

    default:
        // Page non trouvée
        (new NotFound())->execute();
        break;
}