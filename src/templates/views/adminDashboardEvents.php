<?php
require_once __DIR__ . '/../../lib/AuthManager.php';

if(!AuthManager::isConnected()){
    header('Location:' . BASE_URL . 'index.php?page=loginPage');
            exit;
}
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les Hauts de Lo Cantaire - Administration des événements -</title>
    <link rel="stylesheet" href="<?= BASE_URL . 'public/css/adminDashBoard.css' ?>">
</head>

<body>

    <header>
        <nav>
            <a href="<?= BASE_URL . 'index.php?page=homepage'?>">
                <img src="<?= BASE_URL ?>public/images/static/desktop/logoNavbar243x130.webp" alt="Logo Les Hauts de Lo Cantaire">
            </a>
            <ul>
                <li><a href="<?= BASE_URL . 'index.php?page=homepage'?>">Accueil</a></li>
                <li><a href="<?= BASE_URL . 'index.php?page=joinUs'?>">Retrouvez-nous</a></li>
                <li><a href="<?= BASE_URL . 'index.php?page=contact'?>">Contact</a></li>
            </ul>
            
            <div class="navlogout">
            <a href="<?= BASE_URL . 'index.php?page=logout' ?>">Se déconnecter</a>
        </div>
        </nav>
    </header>

    <main>
        <h1>Administration des événements</h1>

        <section>
            <?php if (!empty($events)): ?>
                <?php foreach ($events as $event): ?>
                    <article>
                        <h2><?= htmlspecialchars($event->getTitle()); ?></h2>
                        <p><?= nl2br(htmlspecialchars($event->getDescription())); ?></p>
                        <a href="<?= BASE_URL . 'index.php?page=edit-event&id=<?= urlencode($event->getIdEvents())' ?>" class="btn edit_event">Modifier</a>
                        <a href="<?= BASE_URL . 'index.php?page=delete-event&id=<?= urlencode($event->getIdEvents())' ?>" class="btn delete_event">Supprimer</a>
                    </article>
                <?php endforeach; ?>
                <a href="<?= BASE_URL . 'index.php?page=addEvent' ?>" class="btn add_event">Ajouter un nouvel événement</a>
            <?php else: ?>
                <p>Aucun événement n’est disponible pour le moment.</p>
            <?php endif; ?>
        </section>
    </main>

    <?php require_once __DIR__ . '/footer.php' ?>

</body>
</html>
