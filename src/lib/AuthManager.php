<?php



class AuthManager
{
    // Méthode pour connecter l'utilisateur et créer la session
    public static function login(array $adminData): void
    {
        // On démarre la session si elle n'existe pas encore
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // On stocke les infos utiles dans la session
        $_SESSION['admin'] = [
            'id' => $adminData['id'],
            'email' => $adminData['email'],
            'name' => $adminData['pseudo'],
        ];
    }

    // Méthode pour vérifier si l'utilisateur est connecté
    public static function isConnected(): bool
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        return isset($_SESSION['admin']) && !empty($_SESSION['admin']['id']);
    }

    // Méthode pour déconnecter l'utilisateur
    public static function logout(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // On vide la session
        $_SESSION = [];
        session_destroy();
    }
}
