<?php
// Récupérer la liste des films dans la table film

// 1° Connexion à la base de données bd_cinema
/**
 * @var PDO $pdo
 */
require 'config/db-config-bd.php';

// 2° Préparation de la requête
$requete = $connexion->prepare(query: "SELECT * FROM film");

// 3° Exécution de la requête
$requete->execute();

// 4° Récupération des enregistrements
// 1 enregistrement = 1 tableau associatif
$films = $requete->fetchAll(mode: PDO::FETCH_ASSOC);

require 'parts/fonction.php';

?>

<!doctype html>
<html lang="fr"">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/darkly-bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <style>
        body {
            font-family: 'Gluten', cursive;
        }
    </style>
    <title>Nom - Projet Cinema</title>
</head>
<body>
<!--Insertion d'un menu-->
<?php include_once 'parts/menu.php' ?>

    <!-- Card Film -->
<section id="#card" class=" m-5 ">
    <h2>Liste de film </h2>
    <hr class="border border-danger border-2 opacity-75">
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
              <div class='card border border-info col-lg-3 text-light m-3 mx-auto ' style='width: 18rem'>
                  <img src='<?=$image?>' class='card-img-top mt-1' alt='affiche du film'>
                  <div class='text-center my-3'>
                    <h5 class='card-title text-center'><?=$titre?></h5>
                      <div class=" text-center ">
                          <p class='card-text pt-1'><i class="bi bi-stopwatch"></i> <?=convertirMinutesEnHeures($duree)?> | <i class="bi bi-calendar2-event"></i> <?=afficheDateAnnee($date)?></p>
                          <p class='card-text pb-3'><i class="bi bi-geo-alt-fill"></i> <?= $pays?></p>
                      </div>


                      <button type='button' class='btn btn-outline-danger' ><a class='text-decoration-none' href='parts/detail.php?id_film=<?=$id_film?> '>Synopsis</a></button>
                </div>
              </div>
           <?php endforeach; ?>
    </div>
</section>

</body>
</html>