<?php

declare(strict_types=1);

class AdminEventsManagementController
{
    public function execute(): void
    {
        if (!AuthManager::isConnected()) {
            header('Location:' . BASE_URL . 'index.php?page=loginPage');
            exit;
        }

        require_once __DIR__ . '/../templates/views/adminDashboardEvents.php';
    }
}