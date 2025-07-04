<?php

declare(strict_types=1);

require_once __DIR__ . '/../models/Event.php';



class AdminEventsManagementController
{
    public function execute(): void
    {
        $errorMessage = null;
        $success = isset($_GET['success']) && $_GET['success'] == '1';
        
        
        if (!AuthManager::isConnected()) {
            header('Location:' . BASE_URL . 'index.php?page=loginPage');
            exit;
        }

        $config = require __DIR__ . '/../../config/config.php';

        $dsn = "mysql:host={$config['db_host']};dbname={$config['db_name']};charset=utf8";
        $username = $config['db_user'];
        $password = $config['db_pass'];

        try {
            $connection = new DatabaseConnection($dsn, $username, $password);
            $eventsRepository = new EventsRepository($connection);
            $events = $eventsRepository->getAdminEvents();

            if (empty($events)) {
                $errorMessage = "Aucun événement trouvé.";
            }

             require_once __DIR__ . '/../templates/views/adminDashboardEvents.php';           

           
        } catch (\PDOException $e) {
            http_response_code(500);
            $errorMessage = $e->getMessage();
        }

         require_once __DIR__ . '/../templates/views/adminDashboardEvents.php';

         return;       
    }
}