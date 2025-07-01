<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Les Hauts de Lo Cantaire - Administration des événements (ajout) -</title>
    <link rel="stylesheet" href="<?= BASE_URL . 'public/css/adminDashBoard.css' ?>" />
</head>

<body>

    <header>
        <nav>
            <a href="<?= BASE_URL . 'index.php?page=homepage' ?>">
                <img src="<?= BASE_URL . 'public/images/static/desktop/logoNavbar243x130.webp' ?>" alt="Logo Les Hauts de Lo Cantaire" />
            </a>
            <ul>
                <li><a href="<?= BASE_URL . 'index.php?page=homepage' ?>">Accueil</a></li>
                <li><a href="<?= BASE_URL . 'index.php?page=join-us' ?>">Retrouvez-nous</a></li>
                <li><a href="<?= BASE_URL . 'index.php?page=contact' ?>">Contact</a></li>
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

        <h1>Page d'ajout des événements</h1>
        <?php if (!empty($errorMessage)): ?>
            <p class="error-message"><?= $errorMessage ?></p>
        <?php endif ?>
         <?php if ($success): ?>
            <p class="succes-message">Ajout effectué avec succès.</p>
        <?php endif; ?>
                    
            <div class="form-container">
                <form action="<?= BASE_URL . 'index.php?page=add-new-event'?>" method="post">

                   
                    <div class="form-eventGroup">
                        <label for="title">Titre de l'événement</label>
                        <input type="text" id="title" name="title">
                    </div>

                    <div class="form-eventGroup">
                        <label for="description">Description de l'événement</label>
                        <textarea id="description" name="description" rows="5"></textarea>
                    </div>

                    <div class="form-eventGroup">
                        <label for="is_active">Activation ou désactivation de l'événement</label>
                        <input type="checkbox" id="is_active" name="is_active">
                    </div>

                    <div class="form-eventGroup">
                        <label for="start_date">Date de début</label>
                        <input type="date" id="start_date" name="start_date">
                    </div>

                    <div class="form-eventGroup">
                        <label for="end_date">Date de fin</label>
                        <input type="date" id="end_date" name="end_date">
                    </div>

                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken) ?>">

                    <button type= "submit" class="btn submit">Valider</button>

                </form>
    
            </div>

    </main>
    <?php require_once __DIR__ . '/footer.php' ?>

      
    </body>
    </html>