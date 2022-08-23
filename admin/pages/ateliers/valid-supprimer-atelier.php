<?php
session_start();
if (isset($_SESSION['login']) == false) {
    header("Location:../login/connexion.php");
    exit;
}
include_once("../../../includes/inc-fonctions.php");
include_once("../../../bdd/connectBDD.php");
include_once("../../../bdd/deleteAtelier.php");
/***** V E R I F I C A T I O N S D E S P A R A M E T R E S D E L ’ U R L *****/
/* Récupére l'id dans l'url */
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
/* Vérifie la présence de l'id et son format */
if (is_null($id) || $id === false) {
    header("Location:../erreurs-http/400.php"); // bad request
    exit;
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
/***** T R A I T E M E N T D U F O R M U L A I R E *****/
deleteAtelier($id);
header("Location:ateliers-liste.php");
