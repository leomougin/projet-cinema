
<?php

/**
 * @var PDO $pdo
 */
require '../parts/fonction.php';
require '../config/db-config-bd.php';

$requete = $connexion->prepare(query: "SELECT * FROM film");

$requete->execute();

$films = $requete->fetchAll(mode: PDO::FETCH_ASSOC);

// Déterminer si le formulaire à été soumis
// Utilisation d'une variable superglobale $_GET
//$_SERVER : tableau associatif contenant des inforlations sur la requête

$erreurs = [];
$pseudo = "";
$email = "";
$mdp = "";
$mdpconf = "";


if ($_SERVER['REQUEST_METHOD'] === "POST") {

    // Le formluaire a été soumis !
    // Traiter les données du formulaire
    // Récupérer les valeurs saisies par l'utilisateur
    // Superglobal $_POST: tableau associatif

    $pseudo = $_POST['pseudo'];
    $email= $_POST['email'];
    $mdp = $_POST['mdp'];
    $mdpHash = password_hash($mdp, PASSWORD_DEFAULT);

    $mdpconf = $_POST['mdpconf'];


    // Validation des données
    if (empty($pseudo)) {
        $erreurs['pseudo'] = "Un pseudo est olbigatoire !";
    }
    if (empty($email)) {
        $erreurs['email'] = "Un email est olbigatoire !";
    }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreurs['email'] = "L'email n'est pas valide !";
    }
    if (empty($mdp)) {
        $erreurs['mdp'] = "Un mot de passe est olbigatoire !";
    }
    if (empty($mdpconf)) {
        $erreurs['mdpconf'] = "La confirmation de votre mot de passe est olbigatoire !";
    }elseif ($mdp!=$mdpconf){
        $erreurs['mdpconf'] = " Veuillez saisir le même mot de passe !";
    }
    // Traiter les données

    if (empty($erreurs)) {
        // Traitement des données ( insertion dans une base de données )

        $requete = $connexion->prepare(query: "INSERT INTO user (pseudo,email,mot_de_passe) 
            VALUES (?,?,?)");
        $requete->execute(array($pseudo,$email,$mdpHash));
        $details = $requete->fetchAll(mode: PDO::FETCH_ASSOC);

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
<body class="bg-light">

<!--Insertion d'un menu-->
<?php include_once 'menu.php' ?>
<div class="container ">

    <h1 class="text-center my-5 ">Se connecter</h1>
    <div class=" w-50 mx-auto shadow p-5 bg-white">
        <form class="text-black" action="" method="post" novalidate>
            <div class="mb-3">
                <label for="email" class="form-label">Email *</label>
                <input type="text"
                       class="form-control <?= (isset($erreurs['email'])) ? 'border border-2 border-danger' : '' ?>"
                       id="email" name="email" value="<?= $email ?>" placeholder="john77@gmail.com">
                <?php if (isset($erreurs['email'])): ?>
                    <p class='form-text text-danger'><?= $erreurs['email'] ?></p>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="mdp" class="form-label">Mot de passe *</label>
                <input type="password"
                       class="form-control <?= (isset($erreurs['mdp'])) ? 'border border-2 border-danger' : '' ?>"
                       id="mdp" name="mdp" value="<?= $mdp ?>">
                <?php if (isset($erreurs['mdp'])): ?>
                    <p class='form-text text-danger'><?= $erreurs['mdp'] ?></p>
                <?php endif; ?>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary ">Valider</button>
                <p class="mt-3 ">Si vous n'avez pas déjà de compte,<a href="inscription.php"> s'inscrire</a></p>
            </div>

        </form>

    </div>
</div>

<script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>