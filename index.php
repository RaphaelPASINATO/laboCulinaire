<?php
include_once("includes/inc-fonctions.php");
include_once("bdd/connectBDD.php");
include_once("bdd/getLes3ProchainsAteliers.php");
include_once("bdd/getSessionsParAtelier.php");

$lesAteliers = getLes3ProchainsAteliers();
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
            background: url(images/bg.jpg) no-repeat;
            background-size: cover;
        }
    </style>
</head>

<body>
    <header id="header">
        <?php include_once("includes/inc-header.html"); ?>
    </header>

    <section id="main" class="container">
        <p>Si vous aimez les challenges, cuisiner à plusieurs et prendre du bon temps entre collègues ou en famille ? Vous êtes au bon endroit !</p>
        <p>Notre Labo Culinaire du 17eme arrondissement de Paris est l’endroit idéal pour s’amuser autour d’un paquet de farine ou de pipettes d’agar agar.</p>
        <p>Intrigant n'est ce pas... ? Réservez vite un cours et venez profiter d'un atelier culinaire en compagnie de nos chefs cuistots passionnés.</p>
    </section>

    <section id="ateliers">
        <h1 class="text-center">Nos prochains ateliers</h1>

        <div class="d-flex flex-wrap justify-content-center">
            <?php
            //var_dump($lesAteliers);
            foreach ($lesAteliers as $atelier) {
                // génère le nom du fichier image : img-atelier- suivi de l’id de l’atelier
                $rep = str_replace("\\", "/", dirname(__FILE__, 1));
                $img = "images/ateliers/img-atelier-" . $atelier->id . ".jpg";
                if (!file_exists($rep . "/" . $img)) {
                    $img = "images/atelier/img-atelier-default.jpg";
                }
            ?>
                <article>
                    <div class="wrapper-cours"><img src="<?php echo $img; ?>" alt=""></div> <!-- image -->
                    <div class="detail-cours">
                        <h2 class="titre-cours"><?php echo htmlspecialchars($atelier->libelleCategorie); ?></h2> <!-- intitulé -->
                        <div class="d-table">
                            <div class="d-table-row">
                                <div class="d-table-cell"><i class="far fa-clock"></i></div>
                                <div class="d-table-cell"> <?php  echo $atelier->duree; ?> heures </div> <!-- durée -->
                            </div>
                            <div class="d-table-row">
                                <div class="d-table-cell"><i class="fas fa-euro-sign"></i></div>
                                <div class="d-table-cell"> <?php  echo $atelier->prixParPersonne; ?> € par pers.</div> <!-- prix -->
                            </div>
                            <?php
                            // Récupère les 4 premières sessions de l’atelier
                            $lesSessions = getSessionsParAtelier($atelier->id, 4);
                            foreach ($lesSessions as $session) {
                            ?>
                                <div class="d-table-row session">
                                    <div class="d-table-cell"><i class="far fa-calendar-alt"></i></div>
                                    <div class="d-table-cell"> <?php  echo dateAnglaisVersFrancaisFormatLong($session->dateSession). ' ' . timeVersHeure($session ->heureDebut); ?> </div>
                                </div>
                            <?php
                            } // fin du foreach parcourant les sessions de l’atelier
                            ?>
                        </div> <!-- fin div d-table -->
                        <a class="btn-infos" href="detail-atelier.php?id=<?php  echo $atelier->id; ?>">Plus d'infos</a>
                    </div> <!-- fin div detail-cours -->
                </article>
            <?php
            } // fin du foreach parcourant les ateliers
            ?>
        </div>
    </section>

    <section id="chefs" class="py-5">
        <h1 class="text-center">Rencontrez nos chefs</h1>
        <div class="fiches-chefs">
            <div class="fiche">
                <div class="hover ehover8">
                    <img class="img-fluid" src="images/chef1.jpg" alt="">
                    <div class="overlay point">
                        <h4>Freddy</h4>
                        <p class="set1 d-none d-lg-block">
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                        </p>
                        <hr>
                        <hr>
                        <p class="set2 d-none d-lg-block">
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-dribbble"></i></a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="fiche">
                <div class="hover ehover8">
                    <img class="img-fluid" src="images/chef2.jpg" alt="">
                    <div class="overlay point">
                        <h4>Christophe</h4>
                        <p class="set1">
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                        </p>
                        <hr>
                        <hr>
                        <p class="set2">
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-dribbble"></i></a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="fiche">
                <div class="hover ehover8">
                    <img class="img-fluid" src="images/chef3.jpg" alt="">
                    <div class="overlay point">
                        <h4>Martin</h4>
                        <p class="set1">
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                        </p>
                        <hr>
                        <hr>
                        <p class="set2">
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-dribbble"></i></a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="fiche">
                <div class="hover ehover8">
                    <img class="img-fluid" src="images/chef4.jpg" alt="">
                    <div class="overlay point">
                        <h4>Allan</h4>
                        <p class="set1">
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                        </p>
                        <hr>
                        <hr>
                        <p class="set2">
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-dribbble"></i></a>
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <section id="actus" class="fond-actus p-5">
        <h1 class="text-center">Notre actualité</h1>
        <button type="button" class="btn">RETROUVEZ TOUTE NOTRE ACTU SUR FACEBOOK</button>
    </section>

    <?php include_once("includes/inc-footer.html"); ?>

    <script src="vendor/jquery-3.4.1/jquery-3.4.1.min.js"></script>
    <script src="vendor/bootstrap-4.3.1/js/bootstrap.min.js"></script>
    <script src="js/ateliers.min.js"></script>
</body>

</html>