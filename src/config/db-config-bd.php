<?php
// Définir les informations  de connection

const DB_HOST = "localhost:3306";
const DB_NAME = "bd_cinema";
const DB_USER = "root";
const DB_PASSWORD = "";

//Utiliser PDO pour créer une connexion à la DB

$pdo = new PDO(dsn: "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, username: DB_USER, password: DB_PASSWORD);

function getConnexion(): PDO
{
    $pdo = new PDO(
        'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8',
        DB_USER, DB_PASSWORD
    );
    // Activer les erreurs PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
}