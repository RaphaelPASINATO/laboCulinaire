<?php

/***** V E R I F I C A T I O N D U T O K E N *****/
/* Récupére le token reçu dans le formulaire */
$token = filter_input(INPUT_POST, 'token', FILTER_DEFAULT);
/* Récupère les informations du token généré côté serveur */
$tokenGenere = null;
if (isset($_SESSION['token']) == true || empty($_SESSION['token']) == false) {
    $tokenGenere = $_SESSION['token'];
}
$tokenTime = null;
if (isset($_SESSION['token_time']) == true || empty($_SESSION['token_time']) == false) {
    $tokenTime = $_SESSION['token_time'];
}
/* Vérifie la valeur du jeton reçu et sa validité */
$etat_token = verifieToken($token, $tokenGenere, $tokenTime);
if ($etat_token === -1) { // token invalide
    unset($_SESSION['token']);
    unset($_SESSION['token_time']);
    header("Location:../erreurs-http/403.php"); // forbidden
    exit;
}
if ($etat_token === 0) { // token expiré
    $erreurs = ['token' => "Requête expirée. Renouvelez votre demande"];
    return;
}
/***** V E R I C A T I O N D E S D O N N E E S D U F O R M U L A I R E *****/
/* Vérifie que la date est au format yyyy-mm-aa et existe */
$options = ["options" => ["regexp" => "#^\d{4}-\d{2}-\d{2}$#"]];
$dateSession = filter_input(INPUT_POST, 'dateSession', FILTER_VALIDATE_REGEXP, $options);
$erreurs = array();
/* Extrait les parties année, mois et jour pour vérifier que la date existe bien
 A l’aide de la fonction checkdate */
@list($aa, $mm, $dd) = explode('-', $dateSession);
if (!$dateSession || !checkdate($mm, $dd, $aa)) {
    $erreurs['dateSession'] = "date erronée : $dateSession";
}
if ($dateSession < date("Y-m-d")) {
    $erreurs['dateSession'] = "La date ne peut pas être dans le passé";
}
/* Vérifie que l'heure est au format HH:MM */
$options = ['options' => ['regexp' => "#^([0-1][0-9])|(2[0-3]):[0-5][0-9]$#"]];
$heureDebut = filter_input(INPUT_POST, 'heureDebut', FILTER_DEFAULT, $options);
if (!$heureDebut) {
    $erreurs['heureDebut'] = "heure début erronée : $heureDebut";
}

if (count($erreurs) != 0) {
    return;
}
include_once("../../../bdd/connectBDD.php");
$info = "";
$idSession = insertSession($atelier->id, $dateSession, $heureDebut);
header("Location:atelier-planifier-sessions.php?id=$idAtelier");
exit;
