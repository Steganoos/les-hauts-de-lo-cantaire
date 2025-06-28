<?php $title = "Les Hauts de Lo Cantaire - Fiche produit -"; ?>
<?php $css = BASE_URL . "public/css/product.css"; ?>

<?php ob_start(); ?>

<main>
  <article class="product-card">

    <?php if (!empty($errorMessage)): ?>
      <p class="error-message"><?= htmlspecialchars($errorMessage) ?></p>
    <?php else: ?>

      <div class="image">
        <img src="<?= BASE_URL . 'public/images/products/' . htmlspecialchars($product->getImageUrl() ?? 'matcha.jpg'); ?>" alt="<?= htmlspecialchars($product->getAltText() ?? 'Image du produit'); ?>">
      </div>

      <header class="titlePriceStock">
        <h1><?= htmlspecialchars($product->getName()) ?></h1>

        <p class="price">
          <span class="priceTtc">Prix TTC : <?= htmlspecialchars($product->getPriceTtc()) ?> €</span><br>
          <span class="priceKg">Prix au Kg : <?= htmlspecialchars($product->getPriceKg()) ?> €</span>
        </p>

        <p class="stock-info <?= $product->getInStock() ? 'available' : 'unavailable' ?>">
          <span class="stock-label">Stock :</span>
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
        <h2>Ingrédients :</h2>
        <p><?= nl2br(htmlspecialchars($product->getComposition())) ?></p>
      </section>

    <?php endif; ?>

  </article>

  <a href="<?= BASE_URL ?>index.php?page=homepage">Nos autres produits</a>
</main>

<?php $content = ob_get_clean(); ?>

<?php require_once __DIR__ . '/../layout/layout.php'; ?>
