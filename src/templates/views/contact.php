<?php $title = "Les Hauts de Lo Cantaire - Contact -";?>
<?php $css = "/public/css/contact.css";?>

<?php ob_start(); ?>

<article>

    <h2>Les Hauts de Lo Cantaire</h2>
    <p>Hameau de Font-Rousse <br> Chemin des Muriers Sauvages <br> 48240 Le Collet-de-Valvert <br> France <br> Téléphone : 0601020304</p>
</article>

<a href="index.php?page=homepage">Retour à l'accueil</a>
<img src="public/images/static/desktop/logoCevennes278x278.webp" alt="">

<?php $content = ob_get_clean();?>

<?php require_once __DIR__ . '/../layout/layout.php' ?>