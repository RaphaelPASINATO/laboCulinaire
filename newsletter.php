<?php
include_once("includes/inc-fonctions.php");
include_once("bdd/connectBDD.php");
include_once("bdd/getLesOrigines.php");
include_once("bdd/insertNewsletter.php");
include_once("bdd/updateNewsletter.php");
include_once("bdd/getLes3ProchainsAteliers.php");


$lesOrigines = getLesOrigines();

if (count($_POST) > 0) {
    include_once("includes/inc-valid-newsletter.php");
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Le labo culinaire</title>
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i,900" rel="stylesheet">
    <link rel="stylesheet" media="screen" href="vendor/bootstrap-4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/fontawesome-5.10.2-free/css/all.min.css">
    <link rel="stylesheet" media="screen" href="css/styles.min.css">
    <style>
        #header-bottom {
            background: url(images/bg-small-5.jpg) no-repeat;
            background-size: cover;
        }
    </style>
</head>

<body>
    <header id="header-small">
        <div id="header-top">
            <a href="#contact"><i class="fas fa-comments"></i> Contact</a>
            <a href="enconstruction.html"><i class="fas fa-shopping-basket"></i> Compte</a>
            <a href="enconstruction.html"><i class="fas fa-user"></i> Panier</a>
        </div>
        <div id="header-logo">
            <a href="index.php">
                <img src="images/logo.png" alt="" class="d-none d-lg-block">
                <img src="images/logo-small.png" alt="" class="d-block d-lg-none">
            </a>
        </div>
        <nav id="header-nav" class="d-none d-md-block">
            <ul id="menu" class="d-inline-flex align-items-end">
                <li><a href="liste-ateliers.php" title="Accès à tous les ateliers">Tous nos ateliers</a> </li>
                <li><a href="newsletter.php" title="S'inscrire à la newsletter">Newsletter</a> </li>
            </ul>
        </nav>
        <nav id="header-nav-collapse" class="d-block d-md-none">
            <div id="menu-toggle">
                <input type="checkbox">
                <span></span>
                <span></span>
                <span></span>
                <ul id="menu-collapse">
                    <li><a href="liste-ateliers.php" title="Accès à tous les ateliers">Tous nos ateliers</a> </li>
                    <li><a href="newsletter.php" title="S'inscrire à la newsletter">Newsletter</a> </li>
                </ul>
            </div>
        </nav>
        <div id="header-bottom" class="header-bottom"></div>
    </header>

    <section class="container p-5">
        <h1 class="text-center">Inscription à la newsletter</h1>

        <?php
        if (count($_POST) > 0) {
            if (count($erreurs) != 0) {
                echo getListeErreurs($erreurs);
            } else {
                if (empty($info) == false) {
                    echo $info;
                }
            }
        }
        ?>

        <form id="form-inscription" action="" method="post" autocomplete="off" novalidate><!-- autocomplete="off" -->
            <div class="form-group my-4">
                <label for="homme" class="mr-2">Homme</label>
                <input type="radio" id="homme" name="genre" value="homme" <?php if (isset($genre) && $genre == "homme"){ echo 'checked'; } ?> required>
                <label for="femme" class="ml-3 mr-2">Femme </label>
                <input type="radio" id="femme" name="genre" value="femme" <?php if (isset($genre) && $genre == "femme"){ echo 'checked'; } ?> required>
            </div>

            <div class="form-group my-5">
                <label for="mail">Votre email</label>
                <input type="email" class="form-control" id="mail" name="mail" value="<?php if (isset($mail)) { echo htmlspecialchars($mail); } ?>" required placeholder="E-mail">
            </div>

            <div class="form-group my-4">
                <p>Vous souhaitez recevoir :</p>
                <div class="form-check ml-4">
                    <input class="form-check-input" type="checkbox" id="actus" name="actus" <?php if (isset($actus)) { echo 'checked'; } ?> value="1">
                    <label class="form-check-label" for="actus">L'actualité des ateliers cuisine (mensuel)</label>
                </div>
                <div class="form-check ml-4">
                    <input class="form-check-input" type="checkbox" id="offres" name="offres" <?php if (isset($offres)) { echo 'checked'; } ?> value="1">
                    <label class="form-check-label" for="offres">Les offres et bons plans du moment ! (occasionnel)</label>
                </div>
                <div class="form-check ml-4">
                    <input class="form-check-input" type="checkbox" id="recettes" name="recettes" <?php if (isset($recettes)) { echo 'checked'; } ?>  value="1">
                    <label class="form-check-label" for="recettes">3 idées recettes de Chefs par semaine (hebdomadaire)</label>
                </div>
            </div>

            <div class="form-group my-4">
                <label for="idOrigine">Comment avez-vous découvert notre site ?</label>
                <select class="form-control" id="idOrigine" name="idOrigine" required>
                    <option value=''>--- Choisir ----</option>
                    <?php
                    foreach($lesOrigines as $origine) {
                        if (isset($idOrigine) && $idOrigine == $origine->id) { 
                            echo "<option value='$origine->id' selected >". htmlspecialchars($origine->libelle)."</option>";
                        }else {
                            echo "<option value='$origine->id'>". htmlspecialchars($origine->libelle)."</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="form-group my-4">
                <label for="questions">Des questions ?</label>
                <textarea id="questions" class="form-control" name="questions" placeholder="posez vos questions, nous répondrons dans les meilleurs délais"><?php if (isset($questions)) { echo htmlspecialchars($questions); } ?></textarea>
            </div>

            <div id="boutons" class="form-group my-4">
                <input type="submit" class="btn btn-danger" />
                <input type="reset" class="btn btn-light" />
            </div>
        </form>

    </section>

    <footer id="contact" class="py-4 px-0  p-sm-5">
        <h2 class="text-center mb-5"><img src="images/logo_footer.png" alt=""></h2>
        <address>
            11 Avenue Stéphane Mallarmé<br>
            75017 Paris<br>
            Téléphone : <a href="href=" tel:06 06 06 06 06>06 06 06 06 06</a><br>
            Email : <a href="contact@lelaboculinaire.fr">contact@lelaboculinaire.fr</a>
        </address>
        <div id="social_links" class="mt-5">
            <a href="https://www.facebook.com/lelaboculinaire/" title="Visitez notre page Facebook" target="_blank"><i class="fab fa-facebook-square"></i></a>
            <a href="https://www.instagram.com/laboculinaire/" title="Visitez notre page Instagram" target="_blank"><i class="fab fa-instagram"></i></a>
            <a href="https://www.youtube.com/channel/UCAsBY2UzAbI-jbBeSNuirJw" title="Visitez notre page Youtube" target="_blank"><i class="fab fa-youtube-square"></i></a>
            <a href="https://www.pinterest.fr/lelaboculinaire/pins/" title="Visitez notre page Pinterest" target="_blank"><i class="fab fa-pinterest-square"></i></a>
            <a href="https://www.linkedin.com/company/lelaboculinaire/" title="Visitez notre page LinkedIn" target="_blank"><i class="fab fa-linkedin"></i></a>
        </div>
    </footer>

    <script src="vendor/jquery-3.4.1/jquery-3.4.1.min.js"></script>
    <script src="vendor/bootstrap-4.3.1/js/bootstrap.min.js"></script>

</body>

</html>