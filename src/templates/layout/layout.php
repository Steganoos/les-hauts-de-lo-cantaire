<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $title ?></title>
        <link rel="stylesheet" href="<?= $css ?>" />
    

    </head>
    
    <body>
        <?php require_once __DIR__ . '/../views/header.php' ?>
        <?= $content ?>
        <?php require_once __DIR__ . '/../views/footer.php' ?>
    </body>
</html>
