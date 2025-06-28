<?php

declare(strict_types=1);

require_once __DIR__ . '/../lib/database.php';
require_once __DIR__ . '/../models/Event.php';


class JoinUs
{
   public function execute(): void
    {
        $errorMessage = null;

        $config = require_once __DIR__ . '/../../config/config.php';

        $dsn = "mysql:host={$config['db_host']};dbname={$config['db_name']};charset=utf8";
        $username = $config['db_user'];
        $password = $config['db_pass'];

        try {
            $connection = new DatabaseConnection($dsn, $username, $password);
            $eventsRepository = new EventsRepository($connection);
            $events = $eventsRepository->getEvents();
            if(empty($events)){
                $errorMessage = "Aucun événement n’est disponible pour le moment.";
            }

            require_once __DIR__ . '/../templates/views/joinUs.php';      

            
        } catch (\PDOException $e){
        http_response_code(500);
        $errorMessage =  "Erreur de connexion à la base de données. Veuillez réessayer plus tard.";
        require_once __DIR__ . '/../templates/views/joinUs.php';
        return;
        }

    }
}
    
