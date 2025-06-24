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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Les Hauts de Lo Cantaire - Administration des produits -</title>
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
                <li><a href="<?= BASE_URL . 'index.php?page=joinUs' ?>">Retrouvez-nous</a></li>
                <li><a href="<?= BASE_URL . 'index.php?page=contact' ?>">Contact</a></li>
            </ul>

            <div class="navlogout">
            <a href="<?= BASE_URL . 'index.php?page=logout' ?>">Se déconnecter</a>
            </div>
        </nav>
    </header>

    <main>
        <h1>Page d'administration des produits</h1>
        <?php if (!empty($products)): ?>
            <?php foreach ($products as $product): ?>
                <article class="product">
                    <img
                    src="<?= htmlspecialchars(BASE_URL . 'public/images/products/' . ($product->getImageUrl() ?? 'matcha.jpg')) ?>"
                    alt="<?= htmlspecialchars($product->getAltText() ?? 'Image du produit') ?>"
                    />

                    <h2 class="product-name"><?= htmlspecialchars($product->getName()) ?></h2>

                    <p><?= nl2br(htmlspecialchars($product->getDescription())) ?></p>

                    <div class="product-actions">
                        <a href="<?= BASE_URL . 'index.php?page=editProduct&id=' . urlencode($product->getIdProducts()) ?>" class="btn edit">Modifier</a>
                        <a href="<?= BASE_URL . 'index.php?page=deleteProduct&id=' . urlencode($product->getIdProducts()) ?>" class="btn delete">Supprimer</a>
                    </div>
                </article>
            <?php endforeach; ?>
        
        <?php else: ?>
            <p>Aucun produit n’est disponible pour le moment.</p>
        <?php endif; ?>

        <a href="<?= BASE_URL . 'index.php?page=newProduct' ?>" class="btn new-product">Ajouter un produit</a>
    </main>

    <?php require_once __DIR__ . '/footer.php' ?>

</body>
</html>
