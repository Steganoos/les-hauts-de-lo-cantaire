<?php 
// Définition du titre de la page (utilisé dans le layout principal)
$title = "Les Hauts de Lo Cantaire - Accueil -"; 

// Définition du chemin vers le fichier CSS spécifique à cette page
$css = BASE_URL . "public/css/homepage.css"; 


ob_start(); // Démarre la mise en mémoire tampon de la sortie HTML
?>

<main>
    <!-- Lien vers la page "Retrouvez-nous" -->
    <a class="join-us" href="<?= BASE_URL ?>index.php?page=joinUs">Retrouvez-nous</a>
    
    <!-- Description introductive -->
    <p class="description">
        Nous sommes présents dans de nombreux marchés de la région. Vous en trouverez la liste dans la rubrique “Retrouvez-nous”.
    </p>

    <!-- Boucle d'affichage dynamique des produits -->
    <?php foreach ($products as $product): ?>
        <article class="product">
            <!-- Affichage de l'image du produit avec protection XSS via htmlspecialchars.
                 Si aucune image n'est définie, une image par défaut est utilisée -->
            <img src="<?= BASE_URL . htmlspecialchars($product->getImageUrl() ?? 'public/images/static/desktop/matcha.jpg'); ?>" 
                 alt="<?= htmlspecialchars($product->getAltText() ?? 'Image du produit'); ?>">

            <!-- Nom du produit, sécurisé contre les injections -->
            <h2 class="name"><?= htmlspecialchars($product->getName()); ?></h2>

            <!-- Description du produit, avec les sauts de ligne conservés -->
            <p><?= nl2br(htmlspecialchars($product->getDescription())); ?></p>

            <!-- Lien vers la page de détail du produit, en passant son ID dans l'URL -->
            <a href="<?= BASE_URL ?>index.php?page=product&id=<?= urldecode($product->getIdProducts()) ?>">Détail du produit</a>
        </article>
    <?php endforeach; ?>

    <!-- Lien de retour vers l'accueil -->
    <a href="<?= BASE_URL ?>index.php?page=homepage">Retour à l'accueil</a>

    <!-- Logo de la région des Cévennes -->
    <img src="<?= BASE_URL ?>public/images/static/desktop/logoCevennes278x278.webp" alt="Logo de la région des Cévennes">
</main>

<?php 
// Fin de la mise en mémoire tampon et enregistrement du contenu dans la variable $content
$content = ob_get_clean(); 

// Inclusion du layout général du site, qui utilise $title, $css et $content
require_once __DIR__ . '/../layout/layout.php';
?>
