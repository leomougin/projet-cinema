
<?php
session_start();
$pseudo=NULL;
if (empty($_SESSION)) {
    header( "Location: /");
}

if(isset($_SESSION["pseudo"])){
    $pseudo=$_SESSION["pseudo"];
}

if(isset($_SESSION["id_user"])){
    $id_user=$_SESSION["id_user"];
}
require_once '../../base.php';
require_once BASE_PROJECT.'/src/_partials/fonction.php';
require_once BASE_PROJECT.'/src/database/bd-film.php';


// Déterminer si le formulaire à été soumis
// Utilisation d'une variable superglobale $_GET
//$_SERVER : tableau associatif contenant des inforlations sur la requête

$erreurs = [];
$titre = "";
$duree = "";
$resume = "";
$date = "";
$pays = "";
$image = "";


if ($_SERVER['REQUEST_METHOD'] === "POST") {

    // Le formluaire a été soumis !
    // Traiter les données du formulaire
    // Récupérer les valeurs saisies par l'utilisateur
    // Superglobal $_POST: tableau associatif

    $titre = $_POST['titre'];
    $duree = $_POST['duree'];
    $resume = $_POST['resume'];
    $date = $_POST['date'];
    $pays = $_POST['pays'];
    $image = $_POST['image'];

    // Validation des données
    if (empty($titre)) {
        $erreurs['titre'] = "Le titre est olbigatoire !";
    }
    if (empty($duree)) {
        $erreurs['duree'] = "La durée du film est olbigatoire !";
    }
    if (empty($resume)) {
        $erreurs['resume'] = "Le synopsis olbigatoire !";
    }
    if (empty($date)) {
        $erreurs['date'] = "La date de sortie est olbigatoire !";
    }
    if (empty($pays)) {
        $erreurs['pays'] = "Le pays de productin est olbigatoire !";
    }
    if (empty($image)) {
        $titrePourImage= implode('+',  (explode(' ',$titre)));
        $image="https://placehold.co/250x250?text=$titrePourImage";
    }

    // Traiter les données

    if (empty($erreurs)) {
        // Traitement des données ( insertion dans une base de données )
        addFilms($titre,$duree,$resume,$date,$pays,$image,$id_user);

        // Rediriger l'utilisateur vers une autre page du site ( souvent page d'accueil )
        header(header: "Location: ../index.php");
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
<h2 class="text-center mt-5">Ajouter un film </h2>
<hr class="border border-danger border-1 opacity-75 mb-5">

<div class="container ">

    <div class=" w-50 mx-auto shadow p-5 bg-white border border-danger border-1 rounded-5">
        <form class="text-black " action="" method="post" novalidate>
            <div class="mb-3">
                <label for="titre" class="form-label">Titre *</label>
                <input type="text"
                       class="form-control <?= (isset($erreurs['titre'])) ? 'border border-2 border-danger' : '' ?>"
                       id="titre" name="titre" value="<?= $titre ?>" placeholder="Barbie">
                <?php if (isset($erreurs['titre'])): ?>
                    <p class='form-text text-danger'><?= $erreurs['titre'] ?></p>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="duree" class="form-label">Durée du film *</label>
                <input type="number"
                       class="form-control <?= (isset($erreurs['duree'])) ? 'border border-2 border-danger' : '' ?>"
                       id="duree" name="duree" value="<?= $date ?>" placeholder=" 100 ( minutes )">
                <?php if (isset($erreurs['duree'])): ?>
                    <p class='form-text text-danger'><?= $erreurs['duree'] ?></p>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="resume" class="form-label">Résumé *</label>
                <input type="text"
                       class="form-control <?= (isset($erreurs['resume'])) ? 'border border-2 border-danger' : '' ?>"
                       id="resume" name="resume" value="<?= $resume ?>" placeholder="Résumé du film ">
                <?php if (isset($erreurs['resume'])): ?>
                    <p class='form-text text-danger'><?= $erreurs['resume'] ?></p>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">Date de sortie *</label>
                <input type="date"
                       class="form-control <?= (isset($erreurs['date'])) ? 'border border-2 border-danger' : '' ?>"
                       id="date" name="date" value="<?= $date ?>" placeholder="jj/mm/aaaa">
                <?php if (isset($erreurs['date'])): ?>
                    <p class='form-text text-danger'><?= $erreurs['date'] ?></p>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="pays" class="form-label">Pays de production *</label>
                <input type="text"
                       class="form-control <?= (isset($erreurs['pays'])) ? 'border border-2 border-danger' : '' ?>"
                       id="pays" name="pays" value="<?= $pays ?>" placeholder="États-Unis">
                <?php if (isset($erreurs['pays'])): ?>
                    <p class='form-text text-danger'><?= $erreurs['pays'] ?></p>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Affiche du film</label>
                <input type="text"
                       class="form-control <?= (isset($erreurs['image'])) ? 'border border-2 border-danger' : '' ?>"
                       id="image" name="image" value="<?= $image ?>" placeholder="https://placehold.co/250x250?text=Barbie">
                <?php if (isset($erreurs['image'])): ?>
                    <p class='form-text text-danger'><?= $erreurs['image'] ?></p>
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-outline-danger">Valider</button>
        </form>

    </div>
</div>

<script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>