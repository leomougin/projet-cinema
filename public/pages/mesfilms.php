
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


$idUtilisateur=getIdFromPseudo($pseudo);
$films=getFilmsByUser($idUtilisateur[0]['id_user']);
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
<h2 class="text-center mt-5">Mes films </h2>
<hr class="border border-danger border-1 opacity-75 mb-5">

<div class="container ">
<?php if(empty(getFilmsByUser($idUtilisateur[0]['id_user']))): ?>
    <p class="text-center text-danger fs-4 fst-italic"> Vous n'avez ajouter encore aucun film !!</p>
<?php else:?>
    <div class='row row-cols-1 row-cols-md-2  '>
        <?php  foreach ($films as $film):
            $id_film = $film["id_film"];
            $titre = $film["titre"];
            $duree = $film["duree"];
            $resume = $film["resume"];
            $date = $film["date_sortie"];
            $pays = $film["pays"];
            $image = $film["lien_image"];
            ?>
            <div class='card border border-light col-lg-3 text-light m-3 mx-auto rounded-5 pt-3' style='width: 18rem'>
                <img src='<?=$image?>' width="250" height="250" class='card-img-top mt-1 rounded-5' alt='affiche du film'>
                <div class='text-center my-3'>
                    <h5 class='card-title text-center'><?=$titre?></h5>
                    <div class=" text-center ">
                        <p class='card-text pt-1'><i class="bi bi-stopwatch"></i> <?=convertirMinutesEnHeures($duree)?> | <i class="bi bi-calendar2-event"></i> <?=afficheDateAnnee($date)?></p>
                        <p class='card-text pb-3'><i class="bi bi-geo-alt-fill"></i> <?= $pays?></p>
                    </div>


                    <button type='button' class='btn btn-outline-danger' >
                        <a class='text-light link-underline link-underline-opacity-0' href='pages/detail.php?id_film=<?=$id_film?> '>Détails</a>
                    </button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

</div>

<script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>