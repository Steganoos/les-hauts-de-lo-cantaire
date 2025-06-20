<?php

declare(strict_types=1);

class ProductID
{
    public function execute(int $id): void
    {
        if ($id <= 0) {
            http_response_code(400);
            echo "ID de produit invalide.";
            return;
        }

        $config = require __DIR__ . '/../../config/config.php';

        $dsn = "mysql:host={$config['db_host']};dbname={$config['db_name']};charset=utf8";
        $username = $config['db_user'];
        $password = $config['db_pass'];

        try {
            $connection = new DatabaseConnection($dsn, $username, $password);
        } catch (Exception $e) {
            http_response_code(500);
            echo "Erreur de connexion à la base de données.";
            return;
        }

        $productsRepository = new ProductsRepository($connection);

        $product = $productsRepository->getProduct($id);

        require __DIR__ . '/../templates/views/product.php';
    }
}
