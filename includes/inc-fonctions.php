<?php
/** 
 * Fournit les messages d'erreurs sous forme d'une liste à puces HTML.                    
 * 
 * Retourne une liste à puces HTML, d'après les messages d'erreurs contenus 
 * dans le tableau des messages d'erreurs $tabErr. 
 * @param array $tabErr  Tableau des messages d'erreurs  
 * @return string        Source html
 */
function getListeErreurs($tabErr)
{
    $str = '<ul class="erreur">';
    foreach ($tabErr as $erreur) {
        $str .= '<li>' . $erreur . '</li>';
    }
    $str .= '</ul>';
    return $str;
}

/**
 * Transforme une date au format anglais aaaa-mm-jj vers le format français jj/mm/aaaa
 *
 * @param date $uneDate Date au format  aaaa-mm-jj
 * @return string       La date au format français jj/mm/aaaa
 */
function dateFrancaisVersAnglais($uneDate)
{
    @list($jour, $mois, $annee) = explode('/', $uneDate);
    return date("Y-m-d", mktime(0, 0, 0, $mois, $jour, $annee));
}

/**
 * Transforme une date au format anglais aaaa-mm-jj vers le format français jj/mm/aaaa
 *
 * @param date $uneDate Date au format  aaaa-mm-jj
 * @return string       La date au format français jj/mm/aaaa
 */
function dateAnglaisVersFrancais($uneDate)
{
    return date("d/m/Y", strtotime($uneDate));
}

/**
 * Transforme une date au format anglais aaaa-mm-jj vers le format français jj mmmmmm aaaa
 *
 * @param date $uneDate Date au format  aaaa-mm-jj
 * @return string       La date au format français jj mmmmmm aaaa
 */
function dateAnglaisVersFrancaisFormatLong($uneDate)
{
    $lesMois = ['Janvier', 'Févier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
    @list($annee, $mois, $jour) = explode('-', $uneDate);
    return $jour . ' ' . $lesMois[$mois - 1] . ' ' . $annee;
}

/**
 * Transforme une date au format anglais aaaa-mm-jj vers le format français jj mmm. aaaa
 *
 * @param date $uneDate Date au format  aaaa-mm-jj
 * @return string       La date au format français jj mmm. aaaa
 */
function dateAnglaisVersFrancaisFormatLongMoisAbrege($uneDate)
{
    $lesMois = ['Janv.', 'Févr.', 'Mars', 'Avr.', 'Mai', 'Juin', 'Juill.', 'Août', 'Sept.', 'Oct.', 'Nov.', 'Déc.'];
    @list($annee, $mois, $jour) = explode('-', $uneDate);
    return $jour . ' ' . $lesMois[$mois - 1] . ' ' . $annee;
}

/**
 * Transforme une heure hh:mm:ss au format 15h30
 *
 * @param time $uneHeure  Heure au format hh:mm:ss
 * @return string         L'heure au format format hh:mm
 */
function timeVersHeure($time)
{
    return strftime("%Hh%M", strtotime($time));
}

/**
 * Transforme une heure hh:mm au format hh:mm:ss
 *
 * @param time $uneHeure  Heure au format hh:mm:ss
 * @return string         L'heure au format format hh:mm
 */
function heureVersTime($uneHeure)
{
    return $uneHeure . ':00'; // conversion hh:mm en hh:mm:ss
}

/**
* Génère un jeton unique
*
* @param integer $length longueur du jeton généré
*
* @return string jeton
*/
function genereToken($length = 32)
{
if (!isset($length) || intval($length) <= 8) {
$length = 32;
}
if (function_exists('random_bytes')) { // PHP 7.0
return bin2hex(random_bytes($length));
}
if (function_exists('mcrypt_create_iv')) { // PHP 5.3
return bin2hex(mcrypt_create_iv($length, MCRYPT_DEV_URANDOM));
}
if (function_exists('openssl_random_pseudo_bytes')) {
return bin2hex(openssl_random_pseudo_bytes($length)); // PHP 5.2
}
}

/**
* Vérifie la validité d'un jeton
* La durée de validité du jeton est de 15 minutes
*
* @param string $tokenClient le jeton reçu par le client
* @param string $tokenServeur le jeton émis par le serveur
* @param string $tokenTime l'heure d'émission du jeton
*
* @return mixed true si le jeton est correct et encore valide,
* -1 si le jeton est incorrect,
* 0 si le jeton est expiré
*/
function verifieToken($tokenClient, $tokenServeur, $tokenTime)
{
if (is_null($tokenClient) || !isset($tokenClient) || !isset($tokenServeur) ||
!isset($tokenTime) || $tokenServeur !== $tokenClient ) {
return -1;
}
//On récupère le timestamp tel qu'il était il y a 15 minutes
$timestamp_ancien = time() - (15 * 60);
//Si le jeton est expiré
if ($tokenTime < $timestamp_ancien) {
return 0;
}
return true;
}