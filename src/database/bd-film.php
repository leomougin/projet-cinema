<?php
require_once BASE_PROJECT.'/src/config/db-config-bd.php';
require_once BASE_PROJECT.'/src/database/bd-user.php';
require_once BASE_PROJECT.'/src/database/bd-avis.php';



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
    $requete = $pdo->query("SELECT * FROM film WHERE id_film='$id_film'");
    return $requete->fetchAll(PDO::FETCH_ASSOC);
}
function addFilms($titre,$duree,$resume,$date,$pays,$image,$id_user):void
{
    $pdo = getConnexion();
    $requete = $pdo->prepare(query: "INSERT INTO film (titre,duree,resume,date_sortie,pays,lien_image,id_user) 
            VALUES (?,?,?,?,?,?,?)");
    $requete->execute(array($titre,$duree,$resume,$date,$pays,$image,$id_user));
}

function getFilmsByUser($id_user):array
{
    $pdo = getConnexion();
    $requete = $pdo->prepare(query: "SELECT * FROM film WHERE id_user = '$id_user' ");
    $requete ->execute();
    return $requete->fetchAll(mode: PDO::FETCH_ASSOC);
}
