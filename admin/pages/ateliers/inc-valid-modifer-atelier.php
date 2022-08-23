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
//var_dump($_POST)
$intitule = filter_input(INPUT_POST, 'intitule', FILTER_DEFAULT);
$accroche = filter_input(INPUT_POST, 'accroche', FILTER_DEFAULT);
$duree = filter_input(INPUT_POST, 'duree', FILTER_VALIDATE_INT);
$nbPersonnesMin = filter_input(INPUT_POST, 'nbPersonnesMin', FILTER_VALIDATE_INT);
$nbPersonnesMax = filter_input(INPUT_POST, 'nbPersonnesMax', FILTER_VALIDATE_INT);
$prixParPersonne = filter_input(INPUT_POST, 'prixParPersonne', FILTER_VALIDATE_FLOAT);
$idCategorie = filter_input(INPUT_POST, 'idCategorie', FILTER_VALIDATE_INT);
$description = filter_input(INPUT_POST, 'description', FILTER_DEFAULT);

$erreurs = [];

if (is_null($intitule) === true || $intitule == false) {
    $erreurs['intitule'] = "intitule incorrect ou vide";
}
if (is_null($accroche) === true || $accroche == false) {
    $erreurs['accroche'] = "accroche incorrecte ou vide";
}
if (is_null($duree) === true || $duree == false || $duree > 5 || $duree < 1) {
    $erreurs['duree'] = "duree incorrecte ou vide, elle doit être comprise entre 1 et 5";
}
if (is_null($nbPersonnesMin) === true || $nbPersonnesMin == false || $nbPersonnesMin < 1) {
    $erreurs['nbPersonnesMin'] = "nombre de personne minimun incorrecte ou vide, elle doit être supérieur à 0";
}
if (is_null($nbPersonnesMax) === true || $nbPersonnesMax == false || $nbPersonnesMax <= $nbPersonnesMin) {
    $erreurs['nbPersonnesMax'] = "nombre de personne maximum incorrecte ou vide, elle doit être supérieur à 0 et au nombre de personne minimum";
}
if (is_null($prixParPersonne) === true || $prixParPersonne == false || $prixParPersonne < 1) {
    $erreurs['prixParPersonne'] = "le prix par personne est incorrect ou vide, il doit être supérieur à 0";
}
if (is_null($idCategorie) === true || $idCategorie == false) {
    $erreurs['idCategorie'] = "catégorie vide";
}
if (is_null($description) === true || $description == false) {
    $erreurs['description'] = "description incorrecte ou vide";
}

if (count($erreurs) != 0) {
    return;
}
include_once("../../../bdd/connectBDD.php");
updateAtelier(
    $id,
    $intitule,
    $accroche,
    $duree,
    $nbPersonnesMin,
    $nbPersonnesMax,
    $prixParPersonne,
    $idCategorie,
    $description
);
// On redirige vers la page liste des ateliers
header("Location:ateliers-liste.php");
exit;
