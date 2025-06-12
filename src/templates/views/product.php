<?php $title = "Les Hauts de Lo Cantaire - Fiche produit -"; ?>
<?php $css = "/public/css/product.css"; ?>

<?php ob_start(); ?>


<main>
  <article class="product-card">

    <div class="image">
      <img src="<?= htmlspecialchars($product->getImageUrl()) ?>" alt="<?= htmlspecialchars($product->getAltText()) ?>">
    </div>

    <header class="titlePriceStock">
      <h1><?= htmlspecialchars($product->getName()) ?></h1>

      <p class="price">
        <span class="priceTtc">Prix TTC : <?= htmlspecialchars($product->getPriceTtc()) ?> €</span><br>
        <span class="priceKg">Prix au Kg : <?= htmlspecialchars($product->getPriceKg()) ?> €</span>
      </p>

      <p class="stock <?= $product->getInStock() ? 'available' : 'unavailable' ?>">
        <span class="label">Stock :</span>
        <span class="status"><?= $product->getInStock() ? 'Disponible' : 'Indisponible' ?></span>
      </p>
    </header>

    <section class="description">
      <h2>Description :</h2>
      <p><?= nl2br(htmlspecialchars($product->getDescription())) ?></p>
      <p><?= nl2br(htmlspecialchars($product->getAdviceInfo())) ?></p>
      <p><?= nl2br(htmlspecialchars($product->getQualityLabel())) ?></p>
    </section>

    <section class="ingredients">
      <h2>Ingrédient :</h2>
      <p><?= nl2br(htmlspecialchars($product->getComposition())) ?></p>
    </section>

  </article>
</main>

<?php $content = ob_get_clean(); ?>

<?php require_once __DIR__ . '/../layout/layout.php'; ?>
