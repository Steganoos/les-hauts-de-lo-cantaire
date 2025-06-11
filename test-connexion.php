<?php
$dsn = 'mysql:host=127.0.0.1;dbname=les-hauts-de-lo-cantaire;charset=utf8';
$username = 'root';
$password = 'DWWMAdmin2025!';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connexion réussie !";
} catch (PDOException $e) {
    echo "Erreur de connexion PDO : " . $e->getMessage();
}
