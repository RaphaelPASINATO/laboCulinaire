<?php

include_once(__DIR__ . "/../vendor/phpmarkdown-1.9.0/MarkdownInterface.php");
include_once(__DIR__ . "/../vendor/phpmarkdown-1.9.0/Markdown.php");
include_once(__DIR__ . "/../includes/inc-fonctions.php");
include_once(__DIR__ . "/../bdd/connectBDD.php");
include_once(__DIR__ . "/../bdd/getLesAteliers.php");
include_once(__DIR__ . "/../bdd/getSessionsParAtelier.php");
include_once(__DIR__ . "/../bdd/getLesAteliersAvecCriteres.php");

   /* Clic du bouton « appliquer-filtres » : récupérer la liste des ateliers
 correspondant aux critères */

    // A COMPLETER
    $filtrePrix = filter_input(INPUT_POST, 'filtrePrix', FILTER_VALIDATE_INT);
    $idCategorie = filter_input(INPUT_POST, 'idCategorie', FILTER_VALIDATE_INT);

    $erreurs = array();
    $options = ["options" => ["regexp" => "#^\d{4}-\d{2}-\d{2}$#"]];

    $filtreDateDebut = filter_input(INPUT_POST, 'filtreDateDebut', FILTER_VALIDATE_REGEXP, $options);
        /* Extrait les parties année, mois et jour pour vérifier que la date existe bien
     A l’aide de la fonction checkdate */
        @list($aa, $mm, $dd) = explode('-', $filtreDateDebut);
        if (!empty($filtreDateDebut) && !checkdate($mm, $dd, $aa)) {
            $erreurs['filtreDateDebut'] = "date erronée : $filtreDateDebut";
        }
        //echo $filtreDateDebut . "<br>" . date("Y-m-d");
        if (!empty($filtreDateDebut) && $filtreDateDebut < date("Y-m-d")) {
            $erreurs['filtreDateDebut'] = "La date ne peut pas être dans le passé";
        }


    $filtreDateFin = filter_input(INPUT_POST, 'filtreDateFin', FILTER_VALIDATE_REGEXP, $options);
    /* Extrait les parties année, mois et jour pour vérifier que la date existe bien
     A l’aide de la fonction checkdate */
    @list($aa, $mm, $dd) = explode('-', $filtreDateFin);
    if (!empty($filtreDateFin) && !checkdate($mm, $dd, $aa)) {
        $erreurs['filtreDateFin'] = "date erronée : $filtreDateFin";
    }
    if (!empty($filtreDateFin) && $filtreDateFin < date("Y-m-d")) {
        $erreurs['filtreDateFin'] = "La date ne peut pas être dans le passé";
    }
    $lesAteliers = getLesAteliersAvecCriteres(
        $idCategorie,
        $filtrePrix,
        $filtreDateDebut,
        $filtreDateFin
    );

/* Clic du bouton « effacer-filtres » : effacer tous les critères et récupérer
La liste de tous les ateliers */
if (isset($_POST['effacer-filtres'])) {
    unset($idCategorie, $filtrePrix, $filtreDateDebut, $filtreDateFin);
    $lesAteliers = getLesAteliers();
    $erreurs = [];
}


foreach ($lesAteliers as $atelier) {
    // génère le nom du fichier image : img-atelier- suivi de l’id de l’atelier
    $rep = str_replace("\\", "/", dirname(__FILE__,2 ));
    $img = "images/ateliers/img-atelier-" . $atelier->id . ".jpg";
    if (!file_exists($rep . "/" . $img)) {
        $img = "images/atelier/img-atelier-default.jpg";
    }
?>
    <article>
        <div class="wrapper-cours"><img src="<?php echo $img; ?>" alt=""></div> <!-- image -->
        <div class="detail-cours">
            <h2 class="titre-cours"><?php echo htmlspecialchars($atelier->intitule); ?></h2> <!-- intitulé -->
            <div class="d-table">
                <div class="d-table-row">
                    <div class="d-table-cell"><i class="far fa-clock"></i></div>
                    <div class="d-table-cell"> <?php echo $atelier->duree; ?> heures </div> <!-- durée -->
                </div>
                <div class="d-table-row">
                    <div class="d-table-cell"><i class="fas fa-euro-sign"></i></div>
                    <div class="d-table-cell"> <?php echo $atelier->prixParPersonne; ?> € par pers.</div> <!-- prix -->
                </div>
                <?php
                // Récupère les 4 premières sessions de l’atelier
                $lesSessions = getSessionsParAtelier($atelier->id, 4);
                foreach ($lesSessions as $session) {
                ?>
                    <div class="d-table-row session">
                        <div class="d-table-cell"><i class="far fa-calendar-alt"></i></div>
                        <div class="d-table-cell"> <?php echo dateAnglaisVersFrancaisFormatLong($session->dateSession) . ' ' . timeVersHeure($session->heureDebut); ?> </div>
                    </div>
                <?php
                } // fin du foreach parcourant les sessions de l’atelier
                ?>
            </div> <!-- fin div d-table -->
            <a class="btn-infos" href="detail-atelier.php?id=<?php echo $atelier->id; ?>">Plus d'infos</a>
        </div> <!-- fin div detail-cours -->
    </article>
    <?php
} // fin du foreach parcourant les ateliers
    ?>>