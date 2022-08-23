<?php
//var_dump($_POST)
$valide = filter_input(INPUT_POST, 'valide', FILTER_DEFAULT);

$erreurs = [];

if (is_null($valide) === true) {
    $valide = 0;
}
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
include_once("../../../bdd/connectBDD.php");
valideNewsletter($id, $valide);
// On redirige vers la page liste des newsletters
header("Location:newsletters-liste.php");
exit;
