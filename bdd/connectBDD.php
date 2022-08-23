<?php
function connectBDD()
{
$HOTE = 'localhost'; // adresse du serveur MySQL
$PORT = 3306; // port pour les clients mysql
$BASE = 'laboculinaire'; // nom de la base de données
$USER = 'applilaboculinaire'; // nom d'utilisateur pour se connecter
$MDP = 'secret'; // mot de passe de l'utilisateur
/* Tableau associatif d'options par défaut :
- mode d'affichage des erreurs = exceptions,
- mode de récupération des résultats = tableau associatif
- encodage */
$OPTIONS = array(
PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
);
$pdo = null;
try {
$pdo = new PDO("mysql:host=$HOTE;port=$PORT;dbname=$BASE;", $USER, $MDP, $OPTIONS);
} catch (PDOException $e) {
 header('Content-Type: text/html; charset=latin-1');
die ("Erreur connectBDD: " . $e->getMessage() . " - Ligne " . $e->getLine());
}
return $pdo;
}