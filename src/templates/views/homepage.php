<?php $title = "Les Hauts de Lo Cantaire - Accueil -";?>
<?php $css = "/public/css/homepage.css";?>

<?php ob_start(); ?>

<main>
<a class="join-us" href="index.php?page=join_us">Retrouvez-nous</a>
<p class="description">Nous sommes présents dans de nombreux marchés de la région. Vous en trouverez la liste dans la rubrique “Retrouvez-nous”.</p>

<?php foreach ($products as $product): ?>
        <article class="product">
            <img src="<?= htmlspecialchars($product->getImageUrl() ?? '/public/images/default.png'); ?>" 
                 alt="<?= htmlspecialchars($product->getAltText() ?? 'Image du produit'); ?>">
            <h2 class="name"><?= htmlspecialchars($product->getName()); ?></h2>
            <p><?= nl2br(htmlspecialchars($product->getDescription())); ?></p>
            <a href="index.php?page=product&id=<?= htmlspecialchars($product->getIdProducts()) ?>">Détail du produit</a>
        </article>
<?php endforeach; ?>

<a href="index.php?page=homepage">Retour à l'accueil</a>
<img src="public/images/static/desktop/logoCevennes278x278.webp" alt="Logo de la région des Cévennes">
</main>

<?php $content = ob_get_clean();?>
<?php require_once __DIR__ . '/../layout/layout.php' ?>