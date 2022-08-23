<?php
//var_dump($_POST)
$genre = filter_input(INPUT_POST, 'genre', FILTER_DEFAULT);
$mail = filter_input(INPUT_POST, 'mail', FILTER_VALIDATE_EMAIL);
$actus = filter_input(INPUT_POST, 'actus', FILTER_DEFAULT);
$offres = filter_input(INPUT_POST, 'offres', FILTER_DEFAULT);
$recettes = filter_input(INPUT_POST, 'recettes', FILTER_DEFAULT);
$idOrigine = filter_input(INPUT_POST, 'idOrigine', FILTER_VALIDATE_INT);
$questions = filter_input(INPUT_POST, 'questions', FILTER_DEFAULT);

/* Teste les données et génère les messages d'erreurs du tableau */

$erreurs = [];
if (is_null($genre) === true || ($genre != 'homme' && $genre != 'femme')) {
    $erreurs['genre'] = "Veuillez indiquer si vous êtes un homme ou une femme";
}
if (is_null($mail) === true || $mail == false) {
    $erreurs['mail'] = "Adresse mail incorrecte";
}
if (is_null($actus) === true && is_null($offres) && is_null($recettes)) {
    $erreurs['lesNews'] = "Veuilez sélectionner au moins une newsletter";
}
if (is_null($idOrigine) == true || $idOrigine == false) {
    $erreurs['idOrigine'] = "Merci de préciser comment vous avez découvert notre site";
}

if (count($erreurs) != 0) {
    return;
}

if (is_null($actus) === true) {
    $actus = 0;
}
if(is_null($offres) === true) {
    $offres = 0; 
}
if (is_null($recettes) === true) {
    $recettes = 0;
}
include_once("bdd/connectBDD.php");
include_once("bdd/getNewsletterByEmail.php");
$idDemande = getNewsletterByEmail($mail);
$info ="";
if (is_null($idDemande) == true) {
// Si aucune demande n'existe (getNewsletterByEmail a retourné null) => on la crée
insertNewsletter($genre, $mail, $actus, $offres, $recettes, $questions, $idOrigine);
$info ="<h4 class='info-maj-bdd'>
 Votre demande est prise en compte, vous allez recevoir un mail de confirmation<h4>";
} else {
// Si une demande existe => on la modifie ((getNewsletterByEmail a retourné son id)
updateNewsletter($idDemande, $genre, $actus, $offres, $recettes, $questions, $idOrigine);
$info ="<h4 class='info-maj-bdd'>Votre précédente demande a été modifiée,
 vous allez recevoir un mail de confirmation </h4>";
}
unset($genre, $actus, $offres, $recettes, $questions, $idOrigine);