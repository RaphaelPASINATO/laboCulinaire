<?php

/**
 * getlesAteliersAvecCriteres
 * Retourne sous forme d'un tableau d'objets la liste des ateliers
 * répondant aux critères fournis
 *
 * @param mixed $idCategorie id de la catégorie ou false ou null
 * @param mixed $filtrePrix prix maximum pour sélection atelier ou false ou null
 * @param mixed $filtreDateDebut date début pour sélection atelier ou false ou null
 * @param mixed $filtreDateFin date fin pour sélection atelier ou false ou null
 *
 * @return array tableau d'ateliers
 */
function getlesAteliersAvecCriteres(
    $idCategorie,
    $filtrePrix,
    $filtreDateDebut,
    $filtreDateFin
) {
    $pdo = connectBDD();
    $lesAteliers = [];
    $param = [];
    $sql = "select distinct atelier.*, categorie.libelle as libelleCategorie
from atelier
join categorie on categorie.id = atelier.idCategorie
join session on session.idAtelier = atelier.id";
    $clause = " where ";
    if (!empty($idCategorie)) {
        $sql .= "$clause idCategorie = :idCategorie";
        $clause = " and ";
        $param[':idCategorie'] = $idCategorie;
    }
    if (!empty($filtrePrix)) {
        $sql .= "$clause prixParPersonne <= :prixParPersonne";
        $clause = " and ";
        $param[':prixParPersonne'] = $filtrePrix;
    }
    if (!empty($filtreDateDebut)) {
        $sql .= "$clause dateSession >= :dateSessionDebut";
        $clause = " and ";
        $param[':dateSessionDebut'] = $filtreDateDebut;
    }
    if (!empty($filtreDateFin)) {
        $sql .= "$clause dateSession <= :dateSessionFin";
        $clause = " and ";
        $param[':dateSessionFin'] = $filtreDateFin;
    }
    $sql .= " order by atelier.id";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute($param);
        $lesAteliers = $stmt->fetchAll();
        $stmt->closeCursor();
    } catch (PDOException $e) {
        header('Content-Type: text/html; charset=latin-1');
        die("Erreur getlesAteliersAvecCriteres : " . $e->getMessage() .
            " - Ligne " . $e->getLine());
    }
    unset($pdo);
    return $lesAteliers;
}
