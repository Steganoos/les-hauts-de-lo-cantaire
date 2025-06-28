<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les Hauts de Lo Cantaire - Page d'administration -</title>
    <link rel="stylesheet" href="<?= BASE_URL . 'public/css/adminDashBoard.css' ?>">
</head>

<body>

<header>

    <nav class="navbar">
        <a href="<?= BASE_URL . 'index.php?page=homepage' ?>">
        <img src="<?= BASE_URL ?>public/images/static/desktop/logoNavbar243x130.webp" alt="Logo Les Hauts de Lo Cantaire">
        </a>

        <ul class="navlinks">
            <li><a href="<?= BASE_URL . 'index.php?page=homepage' ?>">Accueil</a></li>
            <li><a href="<?= BASE_URL . 'index.php?page=joinUs' ?>">Retrouvez-nous</a></li>
            <li><a href="<?= BASE_URL . 'index.php?page=contact' ?>">Contact</a></li>
        </ul>

        <div class="navlogout">
            <a href="<?= BASE_URL . 'index.php?page=logout' ?>">Se déconnecter</a>
        </div>

    </nav>

</header>

<main>
    <h1>Administration</h1>
    
    <div class="admin-actions">
        <a href="<?= BASE_URL . 'index.php?page=products-management' ?>" class="btn">Gérer les produits</a>
        <a href="<?= BASE_URL . 'index.php?page=events-management' ?>" class="btn">Gérer les événements</a>
        <a href="<?= BASE_URL . 'index.php?page=admins-management' ?>" class="btn">Gérer les administrateurs</a>
    </div>
</main>

<?php require_once __DIR__ . '/footer.php' ?>

</body>
</html>
