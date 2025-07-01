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
                <li><a href="<?= BASE_URL . 'index.php?page=join-us'?>">Retrouvez-nous</a></li>
                <li><a href="<?= BASE_URL . 'index.php?page=contact'?>">Contact</a></li>
            </ul>
            
            <ul class="admin-nav">
                <li><a href="<?= BASE_URL . 'index.php?page=products-management' ?>">Gérer les produits</a></li>
                <li><a href="<?= BASE_URL . 'index.php?page=events-management' ?>">Gérer les événements</a></li>
                <li><a href="<?= BASE_URL . 'index.php?page=admins-managment' ?>">Gérer les administrateurs</a></li>
                <li><a href="<?= BASE_URL . 'index.php?page=logout' ?>">Se déconnecter</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h1>Administration des événements</h1>
        <?php if ($success): ?>
            <p class="succes-message">Suppression effectuée avec succès.</p>
        <?php endif; ?>

        <section>

            <?php if (empty($events)): ?>
                <p>Aucun événement n’est disponible pour le moment.</p>

                <?php else: ?>

                    <?php foreach ($events as $event): ?>
                        <article>
                            <h2><?= htmlspecialchars($event->getTitle()); ?></h2>
                            <p><?= nl2br(htmlspecialchars($event->getDescription())); ?></p>

                            <a href="<?= BASE_URL . 'index.php?page=edit-event&id=' . urlencode($event->getIdEvents()) ?>" class="btn edit_event">Modifier</a>
                            <a href="<?= BASE_URL . 'index.php?page=delete-event&id=' . urlencode($event->getIdEvents()) ?>" class="btn delete_event">Supprimer</a>

                        </article>

                    <?php endforeach; ?>

            <?php endif; ?>
            
            <a href="<?= BASE_URL . 'index.php?page=new-event-page' ?>" class="btn new-event">Ajouter un nouvel événement</a>
                                                
        </section>

        
    </main>
    
    <?php require_once __DIR__ . '/footer.php' ?>

</body>
</html>
