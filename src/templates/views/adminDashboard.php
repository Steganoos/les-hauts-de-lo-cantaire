<?php

$title = "Les Hauts de Lo Cantaire - Page d'administration -";
$css = BASE_URL . "public/css/administration.css";


// Capture du contenu principal
ob_start();
?>

<main>
  <h1>Administration</h1>
  <div>
    <a href="<?= BASE_URL ?>admin/products.php" class="btn">Gérer les produits</a>
    <a href="<?= BASE_URL ?>admin/events.php" class="btn">Gérer les événements</a>
  </div>
</main>

<?php
$content = ob_get_clean();

require_once __DIR__ . '/../layout/layout.php';
?>
