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

        // Vider la session en mémoire
        $_SESSION = [];

        // 2. Supprimer le cookie de session (PHPSESSID)
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),    // nom du cookie
                '',                // valeur vide
                time() - 3600,     // expiration passée
                $params["path"],   // même chemin
                $params["domain"], // même domaine
                $params["secure"], // sécurisé si nécessaire
                $params["httponly"]// HTTP only
            );
        }

        // 3. Détruire la session côté serveur
        session_destroy();
    }
}
