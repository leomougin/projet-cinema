<?php
session_start();
$pseudo = NULL;
if (isset($_SESSION["pseudo"])) {
    $pseudo = $_SESSION["pseudo"];
}
if(isset($_SESSION["id_user"])){
    $id_user=$_SESSION["id_user"];
}
require_once '../../base.php';
require_once BASE_PROJECT.'/src/_partials/fonction.php';
require_once BASE_PROJECT.'/src/database/bd-film.php';
require_once BASE_PROJECT.'/src/database/bd-user.php';



/**
 * @var PDO $pdo
 */

$id_film=NULL;
if(isset($_GET["id_film"])){
    $id_film=$_GET["id_film"];
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
<section id="#detail" class=" m-5 ">
    <?php if($id_film): ?>
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

        $result=getPseudoFromId($id_user);
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
        <?php else: ?>
             <h1 class="text-center fw-bold "> Film introuvable !</h1>
        <?php endif;
    else: ?>
        <h1 class="text-center fw-bold "> Film introuvable !</h1>
    <?php endif; ?>
</section>

<script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>