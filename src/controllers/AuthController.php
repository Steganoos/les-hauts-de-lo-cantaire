<?php

declare(strict_types=1);

require_once __DIR__ . '/../models/Admin.php';
require_once __DIR__ . '/../lib/AuthManager.php';

class AuthController
{
    public function auth(): void
    {
        $errorMessage = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $userPassword = $_POST['password'] ?? '';

            if (!$email || empty($userPassword)) {
                $errorMessage = "Email ou mot de passe invalide.";
                require_once __DIR__ . '/../templates/views/loginPage.php';
                return;
            }

            $config = require __DIR__ . '/../../config/config.php';

            $dsn = "mysql:host={$config['db_host']};dbname={$config['db_name']};charset=utf8";
            $username = $config['db_user'];
            $password = $config['db_pass'];

            try {
                $connection = new DatabaseConnection($dsn, $username, $password);
                $adminRepository = new AdminRepository($connection);
                $admin = $adminRepository->getAdminByEmail($email);

                if ($admin && password_verify($userPassword, $admin->getPassword())) {
                    $adminData = [
                        'id' => $admin->getIdAdmin(),
                        'email' => $admin->getEmail(),
                        'pseudo' => $admin->getPseudo()
                    ];

                    AuthManager::login($adminData);

                    header('Location: ' . BASE_URL . 'index.php?page=adminDashboard');
                    exit;
                } else {
                    $errorMessage = "Identifiants incorrects.";
                    require_once __DIR__ . '/../templates/views/loginPage.php';
                    return;
                }

            } catch (\PDOException $e) {
                http_response_code(500);
                $errorMessage = "Oups désolé, une erreur est survenue. Veuillez réessayer plus tard.";
                require_once __DIR__ . '/../templates/views/loginPage.php';
                return;
            }

        } else {
            // Affiche simplement le formulaire si la requête n’est pas POST (donc GET)
            require_once __DIR__ . '/../templates/views/loginPage.php';
        }
    }
}
