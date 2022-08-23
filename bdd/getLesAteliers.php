<?php

/**
 * getLesAteliers
 * Retourne sous forme d'un tableau d'objets  ateliers
 *
 * @return array tableau d'objets
 */
function getLesAteliers()
{
    $pdo = connectBDD();
    $lesAteliers = [];
    $sql = "SELECT atelier.*, categorie.libelle as libelleCategorie
FROM atelier
JOIN categorie on categorie.id = atelier.idCategorie";

    try {
        $stmt = $pdo->query($sql);
        $lesAteliers = $stmt->fetchAll();
        $stmt->closeCursor();
    } catch (PDOException $e) {
        header('Content-Type: text/html; charset=latin-1');
        die("Erreur getLesAteliers : " . $e->getMessage() .
            " - Ligne " . $e->getLine());
    }
    unset($pdo);
    return $lesAteliers;
}
