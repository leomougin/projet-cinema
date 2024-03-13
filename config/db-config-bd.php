<?php
// Définir les informations  de connection

const DB_HOST = "localhost:3306";
const DB_NAME = "bd_cinema";
const DB_USER = "root";
const DB_PASSWORD = "";

//Utiliser PDO pour créer une connexion à la DB

$connexion = new PDO(dsn: "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, username: DB_USER, password: DB_PASSWORD);