<?php
require_once BASE_PROJECT.'/src/config/db-config-bd.php';

/**
 * @var PDO $pdo
 */


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
function addFilms($titre,$duree,$resume,$date,$pays,$image,$id_user):void
{
    $pdo = getConnexion();
    $requete = $pdo->prepare(query: "INSERT INTO film (titre,duree,resume,date_sortie,pays,lien_image,id_user) 
            VALUES (?,?,?,?,?,?,?)");
    $requete->execute(array($titre,$duree,$resume,$date,$pays,$image,$id_user));
}

