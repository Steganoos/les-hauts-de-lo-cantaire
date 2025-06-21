<?php

declare(strict_types=1);

require_once __DIR__ . '/../models/Admin.php';
require_once __DIR__ . '/../lib/AuthManager.php';



class AuthController
{
    public function auth(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $userPassword = $_POST['password'] ?? '';

            if (!$email || empty($userPassword)) {
                // Rediriger ou afficher une erreur
                $error = "Email ou mot de passe invalide.";
                require_once __DIR__ . '/../templates/views/loginPage.php';
                return;
            }

            $config = require __DIR__ . '/../../config/config.php';

            $dsn = "mysql:host={$config['db_host']};dbname={$config['db_name']};charset=utf8";
            $username = $config['db_user'];
            $password = $config['db_pass'];

            $connection = new DatabaseConnection($dsn, $username, $password);

            $adminRepository = new AdminRepository($connection);
            $admin = $adminRepository->getAdminByEmail($email);

            if ($admin && password_verify($userPassword, $admin->getPassword())) {
                // Connexion réussie

                $adminData = ['id'=>$admin->getIdAdmin(),'email'=>$admin->getEmail(), 'pseudo'=>$admin->getPseudo()];
                AuthManager::login($adminData);
                header('Location: ' . BASE_URL . 'index.php?page=adminDashboard');
                                
                exit;

            } else {
                // Échec de l'authentification
                $error = "Identifiants incorrects.";
                require_once __DIR__ . '/../templates/views/loginPage.php';
                return;
            }
        } else {
            // Affiche simplement le formulaire si GET
            require_once __DIR__ . '/../templates/views/loginPage.php';
        }
    }
}
