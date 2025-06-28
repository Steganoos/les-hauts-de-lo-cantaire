<?php

declare(strict_types=1);

require_once __DIR__ . '/../lib/database.php';
require_once __DIR__ . '/../models/Event.php';


class AdminEditEventController
{
    public function execute(int $id): void
    {
        $errorMessage = null;
        $success = isset($_GET['success']) && $_GET['success'] == '1';

        
        if (!AuthManager::isConnected()) {
            header('Location:' . BASE_URL . 'index.php?page=loginPage');
            exit;
        }
        
        
        
        if (!is_int($id) || $id <= 0)
        {
            http_response_code(400);
            $errorMessage = "ID du produit invalide.";
            require_once __DIR__ . '/../templates/views/adminDashboardEditEvent.php';
            return;
        }

        $config = require __DIR__ . '/../../config/config.php';

        $dsn = "mysql:host={$config['db_host']};dbname={$config['db_name']};charset=utf8";
        $username = $config['db_user'];
        $password = $config['db_pass'];

        try {
            $connection = new DatabaseConnection($dsn, $username, $password);
            $eventsRepository = new EventsRepository($connection);
            $event = $eventsRepository->getAdminEditEvent($id);

            if (empty($event)) {
                http_response_code(404);
                $errorMessage = "Événement introuvable.";
            }

            require_once __DIR__ . '/../templates/views/adminDashboardEditEvent.php';


        } catch (\PDOException $e) {
            http_response_code(500);
            $errorMessage = $e->getMessage();

            require_once __DIR__ . '/../templates/views/adminDashboardEditEvent.php';
            return;
        }

        
    }
}
