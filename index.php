<?php
// Récupérer la liste des films dans la table film

// 1° Connexion à la base de données bd_cinema
/**
 * @var PDO $pdo
 */
require 'config/db-config-bd.php';

// 2° Préparation de la requête
$requete = $pdo->prepare(query: "SELECT * FROM film");

// 3° Exécution de la requête
$requete->execute();

// 4° Récupération des enregistrements
// 1 enregistrement = 1 tableau associatif
$films = $requete->fetchAll(mode: PDO::FETCH_ASSOC);

?>

<!doctype html>
<html lang="fr"">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="assets/css/vapor-bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gluten:wght@100;200;300;400;500;600;700;800;900&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            font-family: 'Gluten', cursive;
        }
    </style>
    <title>Nom - Projet Cinema</title>
</head>
<body>

    <!-- Card Film -->
<section id="#card">
    <div class='row row-cols-1 row-cols-md-2 g-4'>
        <?php  foreach ($films as $film):
            $id_film = $film["id_film"];
            $titre = $film["titre"];
            $duree = $film["duree"];
            $resume = $film["resume"];
            $date = $film["date_sortie"];
            $pays = $film["pays"];
            $image = $film["lien_image"];

            $dureeH=floor($duree/60);
            $dureeM=$duree%60;

            echo "
      <div class='card border border-primary col-lg-6  text-light m-3' style='width: 18rem'>
          <img src='$image' class='card-img-top' alt='affiche du film'>
          <div class='card-body'>
            <h5 class='card-title'>$titre</h5>
            <p class='card-text'>Le film dure $dureeH H $dureeM minutes.</p>
            <a href='#' class='btn btn-primary'>Détails</a>
        </div>
      </div>";
        endforeach;
        echo "</div> " ?>
</section>

</body>
</html>