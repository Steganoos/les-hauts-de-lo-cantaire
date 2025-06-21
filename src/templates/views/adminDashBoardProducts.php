<?php 
// Définition du titre de la page (utilisé dans le layout principal)
$title = "Les Hauts de Lo Cantaire - Page d'administration des produits -"; 

// Définition du chemin vers le fichier CSS spécifique à cette page
$css = BASE_URL . "public/css/adminDashBoard.css"; 


ob_start(); // Démarre la mise en mémoire tampon de la sortie HTML
?>

<main>
    <h1>Page d'administration des produits</h1>
    
    
   <?php foreach ($products as $product): ?>

    <article class="product">

    <div class="image">
      <img src="<?= BASE_URL . 'public/images/products/' . htmlspecialchars($product->getImageUrl() ?? 'matcha.jpg'); ?>" alt="<?= htmlspecialchars($product->getAltText() ?? "Description alternative de l'image"); ?>">
    </div>

    <header class="titlePriceStock">
      <h2><?= htmlspecialchars($product->getName()) ?></h2>

      <p class="price">
        <span class="priceTtc">Prix TTC : <?= htmlspecialchars($product->getPriceTtc()) ?> €</span><br>
        <span class="priceKg">Prix au Kg : <?= htmlspecialchars($product->getPriceKg()) ?> €</span>
      </p>

      <p class="stock <?= $product->getInStock() ? 'available' : 'unavailable' ?>">
        <span class="stock">Stock :</span>
        <span class="status"><?= $product->getInStock() ? 'Disponible' : 'Indisponible' ?></span>
      </p>
    </header>

    <section class="description">
      <h3>Description :</h3>
      <p><?= nl2br(htmlspecialchars($product->getDescription())) ?></p>
      <p><?= nl2br(htmlspecialchars($product->getAdviceInfo())) ?></p>
      <p><?= nl2br(htmlspecialchars($product->getQualityLabel())) ?></p>
    </section>

    <section class="ingredients">
      <h3>Ingrédient :</h3>
      <p><?= nl2br(htmlspecialchars($product->getComposition())) ?></p>
    </section>

  </article>
       
  <a href="<?= BASE_URL ?>index.php?page=editProduct&id=<?= urlencode($product->getIdProducts()) ?>" class="btn edit">Modifier</a>
  <a href="<?= BASE_URL ?>index.php?page=deleteProduct&id=<?= urlencode($product->getIdProducts()) ?>" class="btn delete">Supprimer</a>

  

  <?php endforeach; ?>

  <a href="<?= BASE_URL ?>index.php?page=createProduct" class="btn create">Ajouter</a>

</main>

<?php 
// Fin de la mise en mémoire tampon et enregistrement du contenu dans la variable $content
$content = ob_get_clean(); 

// Inclusion du layout général du site, qui utilise $title, $css et $content
require_once __DIR__ . '/../layout/layout.php';
?>
