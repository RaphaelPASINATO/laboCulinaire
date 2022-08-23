<?php

/***** V E R I F I C A T I O N D U T O K E N *****/
/* Récupére le token transmis dans le formulaire */
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
/* Vérifie la valeur du jeton et sa validité */
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
/***** V E R I F I C A T I O N D U F O R M U L A I R E *****/
$idAtelier = filter_input(INPUT_POST, 'id', FILTER_DEFAULT);
if (is_null($id) || empty($id)) {
    header("Location:../erreurs-http/400.php"); // bad request
    exit;
}
/* Récupération des données du formulaire */
$ficimg = null;
if (!empty($_FILES['ficimg']['name'])) { // vérifie la présence d’un nom de fichier
    $ficimg = $_FILES['ficimg'];
}
$ficbackground = null;
if (isset($_FILES['ficbackground']['name'])) {
    $ficbackground = $_FILES['ficbackground'];
}
if (empty($ficimg) && empty($ficbackground)) { // les 2 fichiers sont vides
    return;
}
/***** T R A I T E M E N T D E S E R R E U R S *****/
$erreursImageAtelier = array();
if (is_null($ficimg) === false && !empty($ficimg['name'])) {
    $erreursImageAtelier = verifierFichier($ficimg);
}
$erreursImageFond = array();
if (is_null($ficbackground) === false && !empty($ficbackground['name'])) {
    $erreursImageFond = verifierFichier($ficbackground);
}
/***** T R A I T E M E N T D E S U P L O A D S *****/
if (count($erreursImageAtelier) == 0 && !is_null($ficimg) && !empty($ficimg['name'])) {
    $path = __DIR__ . "\\..\\..\\..\\images\\ateliers\\";
    $destination = "img-atelier-" . $idAtelier . ".jpg";
    $erreursImageAtelier = traitementFichier($ficimg, $path, $destination);
}
if (
    count($erreursImageFond) == 0 && !is_null($ficbackground) &&
    !empty($ficbackground['name'])
) {
    $path = __DIR__ . "\\..\\..\\..\\images\\ateliers\\fonds\\";
    $destination = "bg-atelier-" . $idAtelier . ".jpg";
    $erreursImageFond = traitementFichier($ficbackground, $path, $destination);
}
// S'il y a des erreurs, on arrête l'exécution du script
if (count($erreursImageAtelier) != 0 || count($erreursImageFond) != 0) {
    return;
}
$info = "<h4 class='info mt-5'>L'(es) image(s) a(ont) bien été uploadée(s)</h4>";

/**
 * Vérifie les caractéristiques du fichier avant upload
 *
 * @param array $fichier Informations fichier transmises dans $_FILES
 *
 * @return array tableau d'erreurs
 */
function verifierFichier($fichier)
{
    $erreurs = array(); // Tableau dans lequel on écrit les messages d’erreur
    $error = $fichier['error'];
    $nom = $fichier['name'];
    if ($error != 0) { // Erreurs durant la tentative d'upload
        switch ($error) {
            case 1: // code UPLOAD_ERR_INI_SIZE
                $erreurs['upload'] = "Le fichier $nom dépasse la taille limite autorisée
             par le serveur (fichier php.ini)";
                break;
            case 2: // code UPLOAD_ERR_FORM_SIZE
                $erreurs['upload'] = "Le fichier $nom dépasse la taille limite autorisée
             dans le formulaire HTML";
                break;
            case 3: // code UPLOAD_ERR_PARTIAL
                $erreurs['upload'] = "L'envoi du fichier $nom a été interrompu pendant le transfert !";
                break;
            case 4: // code UPLOAD_ERR_NO_FILE
                $erreurs['upload'] =  "Aucun fichier $nom n'a été uploadé";
                break;
            case 5: // code UPLOAD_ERR_NO_TMP_DIR
                $erreurs['upload'] =  "Un dossier $nom temporaire est manquant";
                break;
            case 6: // code UPLOAD_ERR_CANT_WRITE
                $erreurs['upload'] =  "Échec de l'écriture du fichier $nom sur le disque!";
                break;
        }
    }
    return $erreurs;
}
/**
 * traitementFichier
 * Effectue l'upload du fichier transmis lorsque cela est possible
 *
 * @param array $fichier Informations fichier transmises dans $_FILES
 * @param string $destination Fichier destination (chemin complet)
 *
 * @return array tableau d'erreurs
 */
function traitementFichier($fichier, $path, $destination)
{
    $erreurs = array();
    $extensionsAutorisees = array("jpg");
    $ficTemp = $fichier['tmp_name'];
    $nom = $fichier['name'];
    $size = $fichier['size'];
    //$infos = pathinfo($_FILES['monfichier']['name']);
    $infos = pathinfo($nom,PATHINFO_EXTENSION);
    //var_dump($infos);
    $extension = $infos;
    //$extension = $infos['extension'];
    if (in_array($extension, $extensionsAutorisees) == false) {
        $erreurs['upload'] = "Le fichier $nom n'a pas l’extension attendue !";
        return $erreurs;
    }
    if ($size == 0) {
        $erreurs['size'] = "Le fichier $nom que vous avez envoyé a une taille nulle";
        return $erreurs;
    }
    if (is_dir($path) == false) {
        $erreurs['upload'] = "Le répertoire de destination n'existe pas !";
        return $erreurs;
    }
    $fic = $path . $destination;
    if (file_exists($fic) == true) {
        $erreurs['upload'] = "Il y a dejà une image pour cet atelier";
        return $erreurs;
    }
    //var_dump($fichier);
    //var_dump($ficTemp);
    //var_dump($destination);
    if (move_uploaded_file($ficTemp, $fic) == false) {
        $erreurs['upload'] = "Le fichier $nom n'a pas pu être déplacé !";
        return $erreurs;
    }

    return $erreurs;
}
