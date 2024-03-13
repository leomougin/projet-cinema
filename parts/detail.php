<?php
require "../config/db-config-bd.php";

/**
 * @var PDO $connexion
 */

$id_film=NULL;
if(isset($_GET["id_film"])){
    $id_film=$_GET["id_film"];
}

    $requete = $connexion->prepare(query: "SELECT * FROM film WHERE id_film=$id_film");
    $requete->execute();
    $details = $requete->fetchAll(mode: PDO::FETCH_ASSOC);

foreach ($details as $detail):
    $id_film = $detail["id_film"];
    $titre = $detail["titre"];
    $duree = $detail["duree"];
    $resume = $detail["resume"];
    $date = $detail["date_sortie"];
    $pays = $detail["pays"];
    $image = $detail["lien_image"];
endforeach;

require 'fonction.php';

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
<?php include_once 'menu.php' ?>

<!-- Card détail -->
<section id="#detail" class=" m-5 ">

<div class="container d-flex bg-danger ps-0">
    <img src=' <?= $detail["lien_image"] ?>' class='w-25 pe-5' alt='affiche du film'>
    <div class='mt-4'>
        <h4 class='text-center mb-4'><strong><?= $detail["titre"] ?></strong></h4>
        <p class=' '>Dure <?= convertirMinutesEnHeures($detail["duree"]) ?> minutes</p>
        <p class=''>Est sortie le <?= afficheDateFr($detail["date_sortie"]) ?></p>
        <p class=''><?= $detail["resume"] ?></p

    </div>
</div>

</section>

</body>
</html>