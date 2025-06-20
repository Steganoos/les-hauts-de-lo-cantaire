<?php

require_once __DIR__ . '/../lib/AuthManager.php';

class AdminDashboardController
{
    public function execute(): void
    {
        if (!AuthManager::isConnected()) {
            header('Location:' . BASE_URL . 'index.php?page=loginPage');
            exit;
        }

        require_once __DIR__ . '/../templates/views/adminDashboard.php';
    }
}
