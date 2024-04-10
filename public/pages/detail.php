<?php
session_start();
$pseudo = NULL;
if (isset($_SESSION["utilisateur"])) {
    $pseudo = $_SESSION["utilisateur"]["pseudo"];
}
if(isset($_SESSION["utilisateur"])){
    $id_user=$_SESSION["utilisateur"]["id"];
}
require_once '../../base.php';
require_once BASE_PROJECT.'/src/_partials/fonction.php';
require_once BASE_PROJECT.'/src/database/bd-film.php';
require_once BASE_PROJECT.'/src/database/bd-user.php';


$id_film=NULL;
if(isset($_GET["id_film"])){
    $id_film=$_GET["id_film"];
}
$Avis=getAvis($id_film);


foreach ($Avis as $avis) {
    var_dump($avis);
    $date = $avis["date"];
    $date_heure = $avis["date_heure"];
    $id_user_avis = $avis["id_user"];
    $id_avis = $avis["id_avis"];
    $note = $avis["note"];
    $titre = $avis["titre"];
    $avis = $avis["avis"];

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
    <title>Nom - Projet Cinema</title>
</head>
<body>



<!--Insertion d'un menu-->
<?php include_once BASE_PROJECT.'/src/_partials/header.php' ?>

<!-- Card détail -->
    <?php if($id_film): ?>
        <section id="#detail" class=" m-5 ">
        <?php $details=getDetails($id_film);

        foreach ($details as $detail):
        $id_film = $detail["id_film"];
        $titre = $detail["titre"];
        $duree = $detail["duree"];
        $resume = $detail["resume"];
        $date = $detail["date_sortie"];
        $pays = $detail["pays"];
        $image = $detail["lien_image"];
        $id_user=$detail["id_user"];
        endforeach;
        if($id_user==NULL) {
            $id_user = 2;
        }
        $result=getPseudoFromId($id_user);

        // porblème quand id = NULL
        $pseudoCreateFilm=$result[0]["pseudo"];
         if ($details!=null): ?>
            <h2 class="text-center">Détails </h2>
            <hr class="border border-danger border-1 opacity-75 mb-5">
            <div class=" p-5 container text-black d-flex bg-white ps-0 border border-danger border-1 rounded-5 ">
                <img src=' <?= $detail["lien_image"] ?>' class='w-25 px-5' alt='affiche du film'>
                <div class='mt-4'>
                    <h4 class='text-center mb-4'><strong><?= $detail["titre"] ?></strong></h4>
                    <p class=' '>Dure <?= convertirMinutesEnHeures($detail["duree"]) ?> minutes</p>
                    <p class=''>Est sortie le <?= afficheDateFr($detail["date_sortie"]) ?></p>
                    <p class=''><?= $detail["resume"] ?></p>
                    <p class='text-end'>Ce film a été créé par <?=$pseudoCreateFilm?></p>
                    <p></p>
                </div>
            </div>
         </section>
        <section id="#avis" class=" m-5 ">
            <h2 class="text-center">Avis </h2>
            <hr class="border border-danger border-1 opacity-75 mb-5">
            <a class="text-end" href="/pages/avis.php?id_film=<?=$id_film?>">Ajouter un avis</a>



        </section>
        <?php else: ?>
    <section id="#detail" class=" m-5 ">

        <h1 class="text-center fw-bold "> Film introuvable !</h1>
    </section>

         <?php endif;?>
    <?php else:?>
        <section id="#detail" class=" m-5 ">
            <h1 class="text-center fw-bold "> Film introuvable !</h1>
        </section>

    <?php endif;?>


<script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>