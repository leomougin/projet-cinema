<?php
require_once BASE_PROJECT.'/src/config/db-config-bd.php';
require_once BASE_PROJECT.'/src/database/bd-user.php';
require_once BASE_PROJECT.'/src/database/bd-film.php';



/**
 * @var PDO $pdo
 */

function addAvis($titre,$avis,$date,$note,$id_user,$id_film):void
{
    $pdo = getConnexion();
    $requete = $pdo->prepare(query: "INSERT INTO film (titre,avis,date,note,id_user,id_film) 
            VALUES (?,?,?,?,?,?)");
    $requete->execute(array($titre,$avis,$date,$note,$id_user,$id_film));
}