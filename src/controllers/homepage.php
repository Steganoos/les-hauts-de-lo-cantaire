<?php

declare(strict_types=1);

require_once __DIR__ . '/../lib/database.php';
require_once __DIR__ . '/../models/Product.php';



class Homepage
{
    public function execute(): void
    {
        $config = require __DIR__ . '/../../config/config.php';

        $dsn = "mysql:host={$config['db_host']};dbname={$config['db_name']};charset=utf8";
        $username = $config['db_user'];
        $password = $config['db_pass'];

        $connection = new DatabaseConnection($dsn, $username, $password);

        $productsRepository = new ProductsRepository($connection);

        $products = $productsRepository->getProductsWithImages();

        require_once __DIR__ .  '/../templates/views/homepage.php';
    }
}