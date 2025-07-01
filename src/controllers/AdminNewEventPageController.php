<?php

require_once __DIR__ . '/../lib/Csrf.php';


class AdminNewEventPageController
{
    public function execute(): void
    {

         $success = isset($_GET['success']) && $_GET['success'] === '1';
        
        if (!AuthManager::isConnected()) {
            header('Location:' . BASE_URL . 'index.php?page=loginPage');
            exit;
        }

        $csrfToken = CSRFToken::generate();
        require_once __DIR__ . '/../templates/views/adminDashboardNewEvent.php';

    }
}