<?php $title = "Les Hauts de Lo Cantaire - Retrouvez-nous -";?>
<?php $css = "/public/css/joinUs.css"; ?>


<?php ob_start(); ?>

<main>
    <h2>Venez goûter, échanger, et repartir avec un peu de terroir dans votre panier !</h2>
    <p>Retrouvez-nous tout au long de l’année sur les marchés, foires et événements de producteurs dans toute la région. Nous aimons aller à votre rencontre pour partager notre savoir-faire, faire découvrir nos produits et valoriser les saveurs authentiques des Cévennes.
Vous pouvez aussi passer à la maison pour découvrir et acheter nos produits. Comme nous sommes souvent en vadrouille entre marchés et récoltes, un petit coup de fil avant de venir est toujours une bonne idée. Et si nous ne répondons pas, notre répondeur vous donnera les infos utiles pour nous retrouver ou laisser un message. Toutes nos coordonnées sont disponibles dans la rubrique “Nous contacter”.</p>
   
    <section>
    <?php if (!empty($events)): ?>
    <?php foreach ($events as $event): ?>
        <article>
            <h2><?= htmlspecialchars($event->getTitle()); ?></h2>
            <p><?= htmlspecialchars($event->getDescription()); ?></p>
        </article>
    <?php endforeach; ?>
    <?php else: ?>
    <p>Aucun événement n’est disponible pour le moment.</p>
    <?php endif; ?>
    </section>
    
    <a class='returnHome' href="index.php?page=homepage">Retour à l'accueil</a>
    <img src="public/images/static/desktop/logoCevennes278x278.webp" alt="Logo officiel de la région des Cévennes">
    </main>


<?php $content = ob_get_clean();?>
<?php require_once __DIR__ . '/../layout/layout.php' ?>