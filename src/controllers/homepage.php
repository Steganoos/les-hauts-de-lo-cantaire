<?php

// src/controllers/Homepage.php

require_once 'config/config.php';
require_once 'src/lib/DatabaseConnection.php';
require_once 'src/models/Product.php';
require_once 'src/models/ProductsRepository.php';

class Homepage
{
    public function execute()
    {
        $config = require 'config/config.php';

        $dns = "mysql:host={$config['db_host']};dbname={$config['db_name']};charset=utf8";
        $username = $config['db_user'];
        $password = $config['db_pass'];

        $connection = new DatabaseConnection($dns, $username, $password);

        $productsRepository = new ProductsRepository($connection);
        
        $products = $productsRepository->getProducts();

        require 'src/templates/views/homepage.php';
    }
}
