
<?php
session_start();
$pseudo=NULL;
// Remettre après avoir finis config de création des avis
//if (empty($_SESSION)) {
//    header( "Location: /");
//}

if(isset($_SESSION["utilisateur"])){
    $pseudo=$_SESSION["utilisateur"]["pseudo"];
}

if(isset($_SESSION["utilisateur"])){
    $id_user=$_SESSION["utilisateur"]["id"];
}
require_once '../../base.php';
require_once BASE_PROJECT.'/src/_partials/fonction.php';
require_once BASE_PROJECT.'/src/database/bd-film.php';

$id_film=NULL;
if(isset($_GET["id_film"])){
    $id_film=$_GET["id_film"];
}

// Déterminer si le formulaire à été soumis
// Utilisation d'une variable superglobale $_GET
//$_SERVER : tableau associatif contenant des inforlations sur la requête

$erreurs = [];
$titre = "";
$avis="";
$note=0;



if ($_SERVER['REQUEST_METHOD'] === "POST") {

    // Le formluaire a été soumis !
    // Traiter les données du formulaire
    // Récupérer les valeurs saisies par l'utilisateur
    // Superglobal $_POST: tableau associatif

    $titre = $_POST['titre'];
    $avis = $_POST['avis'];
    $note = $_POST['note'];
    $id_film=$id_film;

    // Validation des données
    if (empty($titre)) {
        $erreurs['titre'] = "Le titre est olbigatoire !";
    }

    if (empty($avis)) {
        $erreurs['resume'] = "Un avis est olbigatoire !";
    }
    if (empty($note)) {
        $erreurs['date'] = "Une note est olbigatoire !";
    }



    // Traiter les données
    if (empty($erreurs)) {
        // Traitement des données ( insertion dans une base de données )
        addAvis($titre,$avis,$note,date("Y-m-d"),date("H:i:s"),$id_user,$id_film);

        // Rediriger l'utilisateur vers une autre page du site ( souvent page d'accueil )
        header(header: 'Location: / ');
        exit();
    }
}
?>
<!doctype html>
<html lang="fr"">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/darkly-bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">

    <style>
        body {
            font-family: 'Gluten', cursive;
        }
    </style>
    </style>
    <title>Nom - Projet Cinema</title>
</head>
<body>

<!--Insertion d'un menu-->
<?php include_once BASE_PROJECT.'/src/_partials/header.php' ?>
<h2 class="text-center mt-5">Ajouter un avis </h2>
<hr class="border border-danger border-1 opacity-75 mb-5">

<div class="container ">

    <div class=" w-50 mx-auto shadow p-5 bg-white border border-danger border-1 rounded-5">
        <form class="text-black " action="" method="post" novalidate>
            <div class="mb-3">
                <label for="titre" class="form-label">Titre *</label>
                <input type="text"
                       class="form-control <?= (isset($erreurs['titre'])) ? 'border border-2 border-danger' : '' ?>"
                       id="titre" name="titre" value="<?= $titre ?>" placeholder="Titre de votre avis ">
                <?php if (isset($erreurs['titre'])): ?>
                    <p class='form-text text-danger'><?= $erreurs['titre'] ?></p>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="avis" class="form-label">Avis *</label>
                <textarea type="text"
                       class="form-control <?= (isset($erreurs['avis'])) ? 'border border-2 border-danger' : '' ?>"
                          id="avis" name="avis" placeholder="Avis à propos du film "></textarea>
                <?php if (isset($erreurs['resume'])): ?>
                    <p class='form-text text-danger'><?= $erreurs['avis'] ?></p>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="note" class="form-label">Note *</label>
                <input type="number"
                       min="0"
                       max="5"
                       class="form-control <?= (isset($erreurs['note'])) ? 'border border-2 border-danger' : '' ?>"
                       id="note" name="note" value="<?= $note ?>" >
                <?php if (isset($erreurs['note'])): ?>
                    <p class='form-text text-danger'><?= $erreurs['note'] ?></p>
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-outline-danger">Valider</button>
        </form>

    </div>
</div>

<script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>