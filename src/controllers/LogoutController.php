<?php

declare(strict_types=1);

class LogoutController
{
    public function execute(): void
    {
        AuthManager::logout();

        header('Location:' . BASE_URL . 'index.php?page=loginPage');
        exit;
    }
}
