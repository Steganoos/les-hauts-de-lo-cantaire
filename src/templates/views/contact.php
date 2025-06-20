<?php 
$title = "Les Hauts de Lo Cantaire - Contact -";
$css = BASE_URL . "public/css/contact.css";

ob_start(); 
?>

<main>
  <article>
    <h2>Les Hauts de Lo Cantaire</h2>
    <p>
      Hameau de Font-Rousse <br>
      Chemin des Mûriers Sauvages <br>
      48240 Le Collet-de-Valvert <br>
      France <br>
      Téléphone : 0601020304
    </p>
  </article>

  <a href="<?= BASE_URL ?>index.php?page=homepage">Retour à l'accueil</a>
  <img src="<?= BASE_URL ?>public/images/static/desktop/logoCevennes278x278.webp" alt="">
</main>

<?php 
$content = ob_get_clean();
require_once __DIR__ . '/../layout/layout.php';
?>
