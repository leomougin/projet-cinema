
<?php
 session_start();
if (!empty($_SESSION)) {
    header( "Location: /");
}
require_once '../../base.php';
require_once BASE_PROJECT . '/src/config/db-config-bd.php';
require_once BASE_PROJECT.'/src/_partials/fonction.php';
require_once BASE_PROJECT.'/src/database/bd-user.php';



// Déterminer si le formulaire à été soumis
// Utilisation d'une variable superglobale $_GET
//$_SERVER : tableau associatif contenant des inforlations sur la requête

$erreurs = [];
$email = "";
$mdp = "";
$users = getUser();

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    // Le formluaire a été soumis !
    // Traiter les données du formulaire
    // Récupérer les valeurs saisies par l'utilisateur
    // Superglobal $_POST: tableau associatif

    $email= $_POST['email'];
    $mdp = $_POST['mdp'];


    // Validation des données

    if (empty($email)) {
        $erreurs['connexion'] = "L'email ou le mot de passe n'est pas valide !";
    }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreurs['connexion'] = "L'email ou le mot de passe n'est pas valide !";
    }
    if (empty($mdp)) {
        $erreurs['connexion'] = "L'email ou le mot de passe n'est pas valide !";
    }

    // Traiter les données
    if (empty($erreurs)) {
        // Traitement des données ( insertion dans une base de données )

        foreach ($users as $user) {
            if(!checkMailExists($email)){
                $erreurs["connexion"]="L'email ou le mot de passe n'est pas valide !";

            }
            elseif(!password_verify($mdp,$user["mot_de_passe"])){
                $erreurs["connexion"]="L'email ou le mot de passe n'est pas valide !";

            }

            else{
                $utilisateurs = getUserFromEmail($email);
                print_r($utilisateurs);

                $_SESSION["utilisateur"]=[
                        "id" => $utilisateurs[0]["id_user"],
                    "pseudo" => $utilisateurs[0]["pseudo"],
                     "email" => $utilisateurs[0]["email"],
                ];

                // Rediriger l'utilisateur vers une autre page du site ( souvent page d'accueil )
                header( "Location: ../index.php");
                exit();
            }
        }
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
<h2 class="text-center mt-5">Se connecter</h2>
<hr class="border border-danger border-1 opacity-75 mb-5">

<div class="container ">
    <div class=" w-50 mx-auto shadow p-5 bg-white rounded-5">
        <form class="text-black" action="" method="post" novalidate>
            <div class="mb-3">
                <label for="email" class="form-label">Email *</label>
                <input type="email"
                       class="form-control <?= (isset($erreurs['connexion'])) ? 'border border-2 border-danger' : '' ?>"
                       id="email" name="email" value="<?= $email ?>" placeholder="john77@gmail.com">
                <?php if (isset($erreurs['connexion'])): ?>
                    <p class='form-text text-danger'><?= $erreurs['connexion'] ?></p>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="mdp" class="form-label">
                    Mot de passe *
                </label>
                <input type="password"
                       class="form-control <?= (isset($erreurs['connexion'])) ? 'border border-2 border-danger' : '' ?>"
                       id="mdp" name="mdp" value="<?= $mdp ?>">
                <?php if (isset($erreurs['connexion'])): ?>
                    <p class='form-text text-danger'><?= $erreurs['connexion'] ?></p>
                <?php endif; ?>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-outline-danger">Valider</button>
                <p class="mt-3 ">Si vous n'avez pas déjà de compte,<a href="inscription.php " class=" text-black "> s'inscrire</a></p>
            </div>

        </form>

    </div>
</div>

<script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>