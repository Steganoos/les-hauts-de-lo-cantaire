<?php

require_once __DIR__ . '/../lib/database.php';
require_once __DIR__ . '/../models/Event.php';

class AdminDeleteEventController{

    public function execute($id): void
    {
        
        $errorMessage = null;
        $success = isset($_GET['success']) && $_GET['success'] == '1';
        
        if(!AuthManager::IsConnected()){
             header('Location:' . BASE_URL . 'index.php?page=loginPage');
            exit;

        }

         if (!is_int($id) || $id <= 0)
        {
            http_response_code(400);
            echo '<h1>400 - ID du produit invalide.</h1>';
            echo '<a href="' . BASE_URL . 'index.php?page=events-management">Retour à la liste des événements</a>';
            return;
        }
         $config = require __DIR__ . '/../../config/config.php';

        $dsn = "mysql:host={$config['db_host']};dbname={$config['db_name']};charset=utf8";
        $username = $config['db_user'];
        $password = $config['db_pass'];

        try {
            $connection = new DatabaseConnection($dsn, $username, $password);
            $eventsRepository = new EventsRepository($connection);
            $eventsRepository->deleteEvent($id);

            // Redirection vers la page d'édition avec message de succès
                header('Location: ' . BASE_URL . 'index.php?page=events-management&success=1');
                exit;

                   
        } catch (\PDOException $e) {
            http_response_code(500);
            
            echo $e->getMessage();
            return;
        }

        
    }
}


