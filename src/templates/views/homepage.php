<?php 
$title = "Les Hauts de Lo Cantaire - Accueil -"; 
$css = BASE_URL . "public/css/homepage.css"; 

ob_start(); 
?>

<main>
    <a class="join-us" href="<?= BASE_URL ?>index.php?page=join-us">Retrouvez-nous</a>

    <p class="description">
        Nous sommes présents dans de nombreux marchés de la région. Vous en trouverez la liste dans la rubrique “Retrouvez-nous”.
    </p>

    <?php if (!empty($errorMessage)): ?>
        <p class="error-message"><?= htmlspecialchars($errorMessage) ?></p>
    <?php else: ?>
        <?php foreach ($products as $product): ?>            
            <article class="product">
                <img
                    src="<?= htmlspecialchars(BASE_URL . 'public/images/products/' . ($product->getImageUrl() ?? 'matcha.jpg')) ?>"
                    alt="<?= htmlspecialchars($product->getAltText() ?? 'Image du produit') ?>"
                />

                <h2 class="name"><?= htmlspecialchars($product->getName()); ?></h2>

                <p><?= nl2br(htmlspecialchars($product->getDescription())); ?></p>

                <a href="<?= BASE_URL . 'index.php?page=product&id=' . urlencode($product->getIdProducts()) ?>">
                    Détail du produit
                </a>
            </article>
        <?php endforeach; ?>
    <?php endif; ?>

    <a href="<?= BASE_URL . 'index.php?page=homepage' ?>">Retour à l'accueil</a>

    <img class="logo-cevennes" src="<?= BASE_URL . 'public/images/static/desktop/logoCevennes278x278.webp' ?>" alt="Logo de la région des Cévennes">
</main>

<?php 
$content = ob_get_clean(); 
require_once __DIR__ . '/../layout/layout.php';
?>
