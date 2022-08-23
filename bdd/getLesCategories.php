<?php

/**
 * getLesCategories
 * Retourne sous forme d'un tableau d'objets les catégories des ateliers
 *
 * @return array tableau d'objets
 */
function getLesCategories()
{
    $pdo = connectBDD();
    $lesCategories = [];
    $sql = "SELECT *
FROM categorie";
    try {
        $stmt = $pdo->query($sql);
        $lesCategories = $stmt->fetchAll();
        $stmt->closeCursor();
    } catch (PDOException $e) {
        header('Content-Type: text/html; charset=latin-1');
        die("Erreur getLesCategories : " . $e->getMessage() .
            " - Ligne " . $e->getLine());
    }
    unset($pdo);
    return $lesCategories;
}
