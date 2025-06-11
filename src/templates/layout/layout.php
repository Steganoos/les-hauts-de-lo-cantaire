<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>

        <?php if (isset($css)) : ?>
        <link rel="stylesheet" href="<?= $css ?>" />
        <?php endif; ?>

    </head>
    
    <body>
        <?php require_once __DIR__ . '/../views/header.php' ?>
        <?= $content ?>
        <?php require_once __DIR__ . '/../views/footer.php' ?>
    </body>
</html>
