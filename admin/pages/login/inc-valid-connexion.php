<?php
/***** V E R I F I C A T I O N D E L A V A L I D I T E D E S D O N N E E S *****/
$login = filter_input(INPUT_POST, 'login', FILTER_DEFAULT);
$password = filter_input(INPUT_POST, 'password', FILTER_DEFAULT);
/***** T R A I T E M E N T D E S E R R E U R S *****/
$erreurs = array();
if (is_null($login) || is_null($password) || empty($login) || empty($password))
$erreurs['login'] = "Les login et le mot de passe doivent être renseignés";
else {
$utilisateur = getInfosUtilisateur($login, $password);
if (is_null($utilisateur)) {
$erreurs['login'] = "Login et/ou mot de passe incorrects";
}
}
if (count($erreurs) > 0) {
return;
}
session_start();
$_SESSION['login'] = $utilisateur->login;
$_SESSION['profil'] = $utilisateur->profil;
// Les informations sont correctes :
// on redirige l'internaute vers la page d’accueil du back-office
header("Location:../accueil/index.php");
exit;
