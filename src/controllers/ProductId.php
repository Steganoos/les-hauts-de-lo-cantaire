<?php

declare(strict_types=1);

class ProductID
{
    public function execute(int $id): void
    {
        $errorMessage = null;

        if ($id <= 0) {
            http_response_code(400);
            $errorMessage = "Une erreur est survenue. Produit introuvable.";
            require_once __DIR__ . '/../templates/views/product.php';
            return;
        }

        $config = require __DIR__ . '/../../config/config.php';

        $dsn = "mysql:host={$config['db_host']};dbname={$config['db_name']};charset=utf8";
        $username = $config['db_user'];
        $password = $config['db_pass'];

        try {
            $connection = new DatabaseConnection($dsn, $username, $password);
            $productsRepository = new ProductsRepository($connection);
            $product = $productsRepository->getProduct($id);
            if(empty($products)){
            $erroMessage = "Aucun produit n’est disponible pour le moment.";
        }

            require __DIR__ . '/../templates/views/product.php';

        } catch (\PDOException $e) {
            http_response_code(500);
            $errorMessage =  "Oups désolé, une erreur est survenue. Veuillez réessayer plus tard.";
            require_once __DIR__ . '/../templates/views/product.php';
            return;
        }
    }
}
