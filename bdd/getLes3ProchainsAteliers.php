<?php

/**
 * getLes3ProchainsAteliers
 * Retourne sous forme d'un tableau d'objets les 3 prochains ateliers
 *
 * @return array tableau d'objets
 */
function getLes3ProchainsAteliers()
{
    $pdo = connectBDD();
    $lesAteliers = [];
    $sql = "SELECT DISTINCT atelier.*, categorie.libelle as libelleCategorie
FROM session
JOIN atelier ON idAtelier = atelier.id
JOIN categorie on categorie.id = atelier.idCategorie
WHERE dateSession > CURDATE()
ORDER BY dateSession LIMIT 3";
    try {
        $stmt = $pdo->query($sql);
        $lesAteliers = $stmt->fetchAll();
        $stmt->closeCursor();
    } catch (PDOException $e) {
        header('Content-Type: text/html; charset=latin-1');
        die("Erreur getLes3ProchainsAteliers : " . $e->getMessage() .
            " - Ligne " . $e->getLine());
    }
    unset($pdo);
    return $lesAteliers;
}
