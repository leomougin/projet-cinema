<?php
require_once BASE_PROJECT.'/src/config/db-config-bd.php';
require_once BASE_PROJECT.'/src/database/bd-user.php';
require_once BASE_PROJECT.'/src/database/bd-film.php';

/**
 * @var PDO $pdo
 */

function addAvis($titre,$avis,$note,$date,$date_heure,$id_user,$id_film):void
{
    $pdo = getConnexion();
    $requete = $pdo->prepare(query: "INSERT INTO avis (titre,avis,note,date,date_heure,id_user,id_film) 
            VALUES (?,?,?,?,?,?,?)");
    $requete->execute(array($titre,$avis,$note,$date,$date_heure,$id_user,$id_film));
}

function getAvis(int $id_film):array
{
    $pdo = getConnexion();
    $requete = $pdo->prepare(query: "SELECT * FROM avis WHERE id_film = :id");
    $requete ->execute([
        "id" => $id_film
    ]);
    return $requete->fetchAll(mode: PDO::FETCH_ASSOC);
}