<?php

// src/controllers/Homepage.php

// $configFilePath = __DIR__ . '/../../config/config.php';
// $config = require $configFilePath;

// var_dump($config);
//exit;


require_once __DIR__ . '/../lib/database.php';
require_once __DIR__ . '/../models/product.php';

class Homepage
{
    public function execute()
    {
        $config = require __DIR__ . '/../../config/config.php';

        $dsn = "mysql:host={$config['db_host']};dbname={$config['db_name']};charset=utf8";
        $username = $config['db_user'];
        $password = $config['db_pass'];

        // Pour vérifier les variables avant la connexion
        // var_dump($dsn, $username, $password);
        // exit;

        $connection = new DatabaseConnection($dsn, $username, $password);

        $productsRepository = new ProductsRepository($connection);

        $products = $productsRepository->getProductsWithImages();

        require 'src/templates/views/homepage.php';
    }
}