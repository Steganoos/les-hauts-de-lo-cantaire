<?php

require_once __DIR__ . '/../models/event.php';

class JoinUs
{
   public function execute()
    {
        $config = require __DIR__ . '/../../config/config.php';

        $dsn = "mysql:host={$config['db_host']};dbname={$config['db_name']};charset=utf8";
        $username = $config['db_user'];
        $password = $config['db_pass'];

        $connection = new DatabaseConnection($dsn, $username, $password);

        $eventsRepository = new EventsRepository($connection);

        $events = $eventsRepository->getEvents();

        require 'src/templates/views/joinUs.php';
    }
}
    
