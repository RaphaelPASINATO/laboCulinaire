<?php
include_once("vendor/phpmarkdown-1.9.0/MarkdownInterface.php");
include_once("vendor/phpmarkdown-1.9.0/Markdown.php");
include_once("includes/inc-fonctions.php");
include_once("bdd/connectBDD.php");
include_once("bdd/getUnAtelier.php");
include_once("bdd/getSessionsParAtelier.php");

$id = filter_input(INPUT_GET, 'id',  FILTER_VALIDATE_INT);
if (is_null($id) === true || $id === false) {
    header("Location: 400.html");
    exit;
}

$atelier = getUnAtelier($id);
if (is_null($atelier) === true) {
    header("Location: 404.html");
    exit;
}
$lesSessions = getSessionsParAtelier($id);
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
        /* Styles dépendant des données */
        <?php
        $rep = str_replace("\\", "/", dirname(__FILE__, 1));
        $url = "images/ateliers/fonds/bg-atelier-" . $atelier->id . ".jpg";
        if (!file_exists($rep . "/" . $url)) {
            $url = "images/ateliers/fonds/bg-atelier-default.jpg";
        }
        echo "#header-bottom {
                background: url($url) no-repeat;
                bakcground-size: cover;
    
            }";
        ?>
    </style>
</head>

<body>
    <header id="header-small">
        <?php include_once("includes/inc-header.html"); ?>
    </header>

    <section id="infos-cours">
        <h1><?php echo htmlspecialchars($atelier->intitule); ?></h1> <!-- intitulé -->
        <h3><?php echo htmlspecialchars($atelier->libelleCategorie); ?></h3> <!-- libelle catégorie -->
        <ul>
            <li><i class='far fa-clock'></i><?php echo $atelier->duree; ?> HEURES</li> <!-- durée -->
            <li><i class='fas fa-users'></i><?php echo $atelier->nbPersonnesMin; ?> MIN - <?php echo $atelier->nbPersonnesMax; ?> MAX</li> <!-- pers. min et max. -->
            <li><i class='fas fa-euro-sign'></i><?php echo $atelier->prixParPersonne; ?> &euro; PAR PERS.</li> <!-- prix -->
            <li><a href='#les-dates'><i class='far fa-calendar-alt'></i>DATES</a></li>
        </ul>
    </section>

    <section id="accroche">
        <h1><?php echo $atelier->accroche; ?></h1>
    </section>

    <section id="description-cours">
        <h2>Description</h2>
        <?php 
        echo Markdown::defaultTransform($atelier->description)
        ?>
        
        <h2 id="les-dates">Dates des prochaines sessions</h2>
        <ul>
            <?php
             $lesSessions = getSessionsParAtelier($atelier->id, 4);
             foreach ($lesSessions as $session) {
                 ?>
                 <li><?php  echo dateAnglaisVersFrancaisFormatLong($session->dateSession). ' ' . timeVersHeure($session ->heureDebut); ?></li>
                 <?php
             }
            ?>
        </ul>
    </section>

    <footer id="contact" class="py-4 px-0  p-sm-5">
        <?php include_once("includes/inc-footer.html"); ?>
    </footer>

    <script src="vendor/jquery-3.4.1/jquery-3.4.1.min.js"></script>
    <script src="vendor/bootstrap-4.3.1/js/bootstrap.min.js"></script>

</body>

</html>