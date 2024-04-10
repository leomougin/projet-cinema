
<?php
session_start();
if (!empty($_SESSION)) {
    header( "Location: /");
}
require_once '../../base.php';
require_once BASE_PROJECT . '/src/database/bd-user.php';
require_once BASE_PROJECT.'/src/_partials/fonction.php';


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
    }elseif(checkMailExists($email)){
        $erreurs["email"]="Un utilisateur s'est déjà inscrit avec cette adresse email!";
    }
    if (empty($mdp)) {
        $erreurs['mdp'] = "Un mot de passe est olbigatoire !";
    }elseif(!isValidMDP($mdp)){
        $erreurs['mdp'] = "Votre mot de passe doit obligatoirement contenir 1 majuscule, 1 minuscule et 1 chiffre et faire entre 8 et 14 caractères !";
    }
    if (empty($mdpconf)) {
        $erreurs['mdpconf'] = "La confirmation de votre mot de passe est olbigatoire !";
    }elseif ($mdp!=$mdpconf){
       $erreurs['mdpconf'] = " Veuillez saisir le même mot de passe !";
    }
    // Traiter les données

    if (empty($erreurs)) {
        // Traitement des données ( insertion dans une base de données )

        addUser($pseudo,$email,$mdpHash);

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
<h2 class="text-center mt-5">S'inscrire</h2>
<hr class="border border-danger border-1 opacity-75 mb-5">
<div class="container ">

    <div class=" w-50 mx-auto shadow p-5 bg-white rounded-5 ">
        <form class="text-black" action="" method="post" novalidate>
            <div class="mb-3">
                <label for="pseudo" class="form-label">Pseudo *</label>
                <input type="text"
                       class="form-control <?= (isset($erreurs['pseudo'])) ? 'border border-2 border-danger' : '' ?>"
                       id="pseudo" name="pseudo" value="<?= $pseudo ?>" placeholder="j0hNdu77">
                <?php if (isset($erreurs['pseudo'])): ?>
                    <p class='form-text text-danger'><?= $erreurs['pseudo'] ?></p>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email *</label>
                <input type="text"
                       class="form-control <?= (isset($erreurs['email'])) ? 'border border-2 border-danger' : '' ?>"
                       id="email" name="email" value="<?= $email ?>" placeholder="john77@gmail.com">
                <?php if (isset($erreurs['email'])): ?>
                    <p class='form-text text-danger'><?= $erreurs['email'] ?></p>
                <?php endif; ?>
                <div id="emailHelp" class="text-light">Nous ne divulgerons jamais votre adresse email.</div>
            </div>
            <div class="mb-3">
                <label for="mdp" class="form-label">Mot de passe *</label>

                <button type="button" class="btn mb-1" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                    <i class="bi bi-info-circle text-black"></i>
                </button>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-danger">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Les caractéristiques de votre mot de
                                    passe </h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body bg-white">
                                <ul>
                                    <li>
                                        Votre mot de passe doit contenir entre 8 et 14 caractères
                                    </li>
                                    <li>
                                        Il doit contenir au moins une minuscule, une majuscule et un chiffre!
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <input type="password"
                       class="form-control <?= (isset($erreurs['mdp'])) ? 'border border-2 border-danger' : '' ?>"
                       id="mdp" name="mdp" value="<?= $mdp ?>">
                <?php if (isset($erreurs['mdp'])): ?>
                    <p class='form-text text-danger'><?= $erreurs['mdp'] ?></p>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="mdpconf" class="form-label">Confirmer le mot de passe *</label>
                <input type="password"
                       class="form-control <?= (isset($erreurs['mdpconf'])) ? 'border border-2 border-danger' : '' ?>"
                       id="mdpconf" name="mdpconf" value="<?= $mdpconf ?>">
                <?php if (isset($erreurs['mdpconf'])): ?>
                    <p class='form-text text-danger'><?= $erreurs['mdpconf'] ?></p>
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-outline-danger">Valider</button>
            <p class="mt-3 ">Si vous avez déjà un compte,<a href="connexion.php" class="text-black "> se connecter</a></p>
        </form>

    </div>
</div>

<script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>