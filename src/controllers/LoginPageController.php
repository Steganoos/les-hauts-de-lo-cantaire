<?php

declare(strict_types=1);

class LoginPageController
{
    public function showLoginForm(): void
    {
        require_once __DIR__ . '/../templates/views/loginPage.php';

    }
}