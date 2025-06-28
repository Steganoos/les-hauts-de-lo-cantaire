<?php

declare(strict_types=1);

require_once __DIR__ . '/../lib/database.php';
require_once __DIR__ . '/../models/Event.php';

class AdminUpdateEventController
{
    public function execute($id): void
    {
        $errormessage = null;

        if (!AuthManager::isConnected()) {
            header('Location:' . BASE_URL . 'index.php?page=loginPage');
            exit;
        }

        if (!is_int($id) || $id <= 0) {
            http_response_code(400);  
            echo '<h1>400 - Requête invalide</h1>';  
            echo '<p>L\'ID fourni est invalide.</p>';  
            echo '<a href="' . BASE_URL . '/index.php?page=events-management">Retour à la liste des événements</a>';  
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Initialiser les variables
            $title = $_POST['title'] ?? null;
            $description = $_POST['description'] ?? null;
            $startDate = $_POST['start_date'] ?? null;
            $endDate = $_POST['end_date'] ?? null;
            $isActive = isset($_POST['is_active']) ? 1 : 0;

            // Contrôle des valeurs
            if (empty($title) || strlen($title) > 150) {
                $errormessage = "Le titre est vide ou trop long.";
            } elseif (empty($startDate) || !strtotime($startDate)) {
                $errormessage = "La date de début est invalide.";
            } elseif (!empty($endDate) && !strtotime($endDate)) {
                $errormessage = "La date de fin est invalide.";
            }

            // En cas d'erreur de formulaire
            if ($errormessage !== null) {
                http_response_code(400);
                echo '<h1>400 - Erreur dans le formulaire</h1>';
                echo '<p>' . htmlspecialchars($errormessage) . '</p>';
                echo '<a href="' . BASE_URL . 'index.php?page=edit-event&id=' . $id . '">Retour à l\'événement</a>';
                exit;
            }

            // Connexion à la base de données
            $config = require __DIR__ . '/../../config/config.php';
            $dsn = "mysql:host={$config['db_host']};dbname={$config['db_name']};charset=utf8";
            $username = $config['db_user'];
            $password = $config['db_pass'];

            try {
                $connection = new DatabaseConnection($dsn, $username, $password);
                $eventsRepository = new EventsRepository($connection);
                $eventsRepository->updateEvents($id, $title, $description, $startDate, $endDate, $isActive);

                // Redirection vers la page d'édition avec message de succès
                header('Location: ' . BASE_URL . 'index.php?page=edit-event&id=' . $id . '&success=1');
                exit;

            } catch (\PDOException $e) {
                http_response_code(500);
                echo '<h1>500 - Erreur de connexion à la base de données.</h1>';
                echo '<p>' . $e->getMessage() . '</p>';
                echo '<a href="' . BASE_URL . 'index.php?page=edit-event&id=' . $id . '">Retour à l\'événement</a>';
                exit;
            }
        }
    }
}


