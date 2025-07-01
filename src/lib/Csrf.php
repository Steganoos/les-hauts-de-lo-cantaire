<?php

class CSRFToken
{

    public static function generate(): string
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // On génère un token sécurisé
        $token = bin2hex(random_bytes(32));
        $_SESSION['csrf_token'] = $token;

        return $token;
    }

     public static function verify(?string $token): bool
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['csrf_token']) || !$token) {
            return false;
        }

        $isValid = hash_equals($_SESSION['csrf_token'], $token);

        // détruire le token après usage pour éviter les réutilisations
        unset($_SESSION['csrf_token']);

        return $isValid;
    }
}
