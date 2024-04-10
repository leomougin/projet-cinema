<?php
require_once BASE_PROJECT.'/src/config/db-config-bd.php';
require_once BASE_PROJECT.'/src/database/bd-film.php';
require_once BASE_PROJECT.'/src/database/bd-avis.php';



function checkMailExists(string $email)
{
    $pdo = getConnexion();
    $stmt = $pdo->prepare('SELECT count(*)
            FROM `user`
            WHERE email = :email');
    $stmt->bindValue(':email', $email);
    $stmt->execute();
    $result = (int)$stmt->fetchColumn();
    return $result;
}
function isValidMDP(string $mdp)
{
    return preg_match('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,14}$/', $mdp)  ;
}
function addUser($pseudo,$email,$mdpHash):void
{
    $pdo = getConnexion();
    $requete = $pdo->prepare(query: "INSERT INTO user (pseudo,email,mot_de_passe) 
                        VALUES (?,?,?)");
    $requete->execute(array($pseudo,$email,$mdpHash));
}
//function verifUser(int $id_user):array
//{
//    $pdo = getConnexion();
//    $requete = $pdo->prepare(query: "SELECT * FROM user WHERE id_user= $id_user ");
//    $requete ->execute();
//    return $requete->fetchAll(mode: PDO::FETCH_ASSOC);
//}
function getUser():array
{
    $pdo = getConnexion();
    $requete = $pdo->prepare(query: "SELECT * FROM user  ");
    $requete ->execute();
    return $requete->fetchAll(mode: PDO::FETCH_ASSOC);
}

function getPseudoFromId(int $id_user):array
{
    $pdo = getConnexion();
    $requete = $pdo->prepare(query: "SELECT pseudo FROM user WHERE id_user LIKE '$id_user' ");
    $requete ->execute();
    return $requete->fetchAll(mode: PDO::FETCH_ASSOC);
}
function getIdFromPseudo( $pseudo):array
{
    $pdo = getConnexion();
    $requete = $pdo->prepare(query: "SELECT id_user FROM user WHERE pseudo LIKE '$pseudo' ");
    $requete ->execute();
    return $requete->fetchAll(mode: PDO::FETCH_ASSOC);
}