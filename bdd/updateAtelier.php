<?php
/**
* updateAtelier
* Ajoute un nouveau atelier dans la base de données
*
* @param int $id nombre identifiant l'atelier
* @param string $intitule le nom de l'atelier
* @param string $accroche une phrase d'accroche correspondant à l'atelier
* @param int $duree la duree de l'atelier en heure
* @param int $nbPersonnesMin le nombre de personne minimum dans l'atelier
* @param int $nbPersonnesMax le nombre de personne maximum dans l'atelier
* @param float $prixParPersonne un réel contenant le prix de l'atelier pour une personne
* @param int $idCategorie identifiant de la categorie de l'atelier
* @param string $description un string contenant la description de l'atelier
*
* @return mixed identifiant de l'atelier ajouté, ou false en cas d'erreur
*/
function updateAtelier($id,$intitule, $accroche, $duree, $nbPersonnesMin, $nbPersonnesMax, $prixParPersonne, $idCategorie, $description) {
    $pdo = connectBDD();
    $ret = false;
    $sql = "UPDATE  atelier
        set intitule =:intitule, accroche =:accroche, duree =:duree, nbPersonnesMin =:nbPersonnesMin, nbPersonnesMax =:nbPersonnesMax, prixParPersonne =:prixParPersonne, idCategorie =:idCategorie, description =:description
        where id =:id";
    $stmt = $pdo->prepare($sql);
    try {
        $stmt->execute([
            ':intitule' => $intitule,
            ':accroche' => $accroche,
            ':duree' => $duree,
            ':nbPersonnesMin' => $nbPersonnesMin,
            ':nbPersonnesMax' => $nbPersonnesMax,
            ':prixParPersonne' => $prixParPersonne,
            ':idCategorie' => $idCategorie,
            ':description' => $description,
            ':id' => $id,
        ]);
    } catch (PDOException $e) {
        header('Content-Type: text/html; charset=latin-1');
        die("Erreur updateAtelier : " . $e->getMessage() . " - Ligne " . $e->getLine());
    }
    unset($pdo);
    return $ret;


}
