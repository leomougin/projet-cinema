<?php
require_once BASE_PROJECT.'/src/config/db-config-bd.php';
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
function checkMailExists($pdo, $email)
{
    $stmt = $pdo->prepare('SELECT count(*)
            FROM `user`
            WHERE email = :email');
    $stmt->bindValue(':email', $email);
    $stmt->execute();
    $result = (int)$stmt->fetchColumn();
    return $result;
}
function isValidMDP($mdp)
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
