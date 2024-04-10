
<header>
    <nav class="navbar navbar-expand-md bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand ms-5  text-danger" href="<?php  BASE_PROJECT?>/"><i class="bi bi-film pe-1"></i>The Movie</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse me-auto mb-2 mb-md-0 justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php  BASE_PROJECT?>/">Accueil</a>
                    </li>
                    <?php if (!empty($_SESSION)): ?>
                        <li class="nav-item ms-2">
                            <a class="nav-link " href="<?php BASE_PROJECT?>/pages/ajouter.php">Ajouter un film</a>
                        </li>
                            <a class="nav-link " href="<?php BASE_PROJECT?>/pages/mesfilms.php">Mes films</a>
                        </li>
                        <li>
                            <a class="nav-link" href="<?php BASE_PROJECT?>/pages/deconnexion.php">Se déconnecter</a>
                        </li>
                    <?php endif ?>
                    <?php if (empty($_SESSION)): ?>
                    <li class="nav-item ms-2">
                        <a class="nav-link btn btn-outline-danger " href="<?php BASE_PROJECT?>/pages/inscription.php">S'inscrire</a>
                    </li>
                    <li class="nav-item ms-2">
                        <a class="nav-link btn btn-outline-danger" href="<?php BASE_PROJECT?>/pages/connexion.php">Se connecter</a>
                    </li>
                    <?php endif ?>
                </ul>
            </div>
        </div>
    </nav>
</header>
<?php if (isset($_SESSION["pseudo"])): ?>
    <p class="fst-italic text-end me-5 mt-3">Vous êtes connecté en tant que <span class="text-danger"><?=$pseudo ?></span> !!</p>
<?php endif ?>
