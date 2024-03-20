<?php
require_once BASE_PROJECT.'/src/config/db-config-bd.php';

/**
 * @var PDO $pdo
 */

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
function getFilms(): array
{
    $pdo = getConnexion();
    $requete = $pdo->query("SELECT * FROM film");
    return $requete->fetchAll(PDO::FETCH_ASSOC);
}
function getDetails($id_film): array
{
    $pdo = getConnexion();
    $requete = $pdo->query("SELECT * FROM film WHERE id_film=$id_film");
    return $requete->fetchAll(PDO::FETCH_ASSOC);
}
function addFilms($titre,$duree,$resume,$date,$pays,$image):void
{
    $pdo = getConnexion();
    $requete = $pdo->prepare(query: "INSERT INTO film (titre,duree,resume,date_sortie,pays,lien_image) 
            VALUES (?,?,?,?,?,?)");
    $requete->execute(array($titre,$duree,$resume,$date,$pays,$image));
}

