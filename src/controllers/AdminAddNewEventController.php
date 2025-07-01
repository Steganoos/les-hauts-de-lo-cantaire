<?php

require_once __DIR__ . '/../lib/database.php';
require_once __DIR__ . '/../models/Event.php';
require_once __DIR__ . '/../lib/Csrf.php';

class AdminAddNewEventController
{
    public function execute(): void
    {
        $errormessage = null;

        if (!AuthManager::isConnected()) {
            header('Location:' . BASE_URL . 'index.php?page=loginPage');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Vérification du token CSRF
            $csrfToken = $_POST['csrfToken'] ?? '';
            if (!CSRFToken::verify($csrfToken)) {
                http_response_code(403);
                echo '<h1>403 - Requête interdite</h1>';
                echo '<p>Le jeton CSRF est invalide ou manquant.</p>';
                echo '<a href="' . BASE_URL . 'index.php?page=new-event-page">Retour à la page d\'ajout d\'événement</a>';
                exit;
            }

            // Initialiser les variables
            $title = $_POST['title'] ?? null;
            $description = $_POST['description'] ?? null;
            $startDate = $_POST['start_date'] ?? null;
            $endDate = $_POST['end_date'] ?? null;
            $isActive = isset($_POST['is_active']) ? 1 : 0;

            // Contrôle des valeurs
            if (trim($title) === '' || strlen($title) > 150) {
                $errormessage = "Le titre est vide ou trop long.";
            } elseif (trim($description) === '') {
                $errormessage = "La description est vide.";
            } elseif (empty($startDate) || !strtotime($startDate)) {
                $errormessage = "La date de début est invalide.";
            } elseif (!empty($endDate) && !strtotime($endDate)) {
                $errormessage = "La date de fin est invalide.";
            } elseif (!empty($endDate) && strtotime($endDate) < strtotime($startDate)) {
                $errormessage = "La date de fin ne peut pas être antérieure à la date de début.";
            }

            // En cas d'erreur de formulaire
            if ($errormessage !== null) {
                http_response_code(400);
                echo '<h1>400 - Erreur dans le formulaire</h1>';
                echo '<p>' . htmlspecialchars($errormessage) . '</p>';
                echo '<a href="' . BASE_URL . 'index.php?page=new-event-page">Retour à la page d\'ajout d\'événement</a>';
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
                $eventsRepository->newEvent($title, $description, $startDate, $endDate, $isActive);

                // Redirection vers la page de succès
                header('Location: ' . BASE_URL . 'index.php?page=new-event-page&success=1');
                exit;

            } catch (\PDOException $e) {
                http_response_code(500);
                echo '<h1>500 - Erreur de connexion à la base de données.</h1>';
                echo '<p>' . $e->getMessage() . '</p>';
                echo '<a href="' . BASE_URL . 'index.php?page=new-event-page">Retour à la page d\'ajout d\'événement</a>';
                exit;
            }
        } else {
            // Rediriger vers le formulaire si l'accès n'est pas en POST
            header('Location: ' . BASE_URL . 'index.php?page=new-event-page');
            exit;
        }
    }
}
