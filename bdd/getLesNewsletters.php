<?php

/**
 * getLesNewsLetters
 * Retourne sous forme d'un tableau d'objets les newsletters
 *
 * @return array tableau d'objets
 */
function getLesNewsLetters()
{
    $pdo = connectBDD();
    $lesNewsLetters = [];
    $sql = "SELECT *
FROM newsletter";
//JOIN origine on origine.id = newsletter.id";
    try {
        $stmt = $pdo->query($sql);
        $lesNewsLetters = $stmt->fetchAll();
        $stmt->closeCursor();
    } catch (PDOException $e) {
        header('Content-Type: text/html; charset=latin-1');
        die("Erreur getlesNewsLetters : " . $e->getMessage() .
            " - Ligne " . $e->getLine());
    }
    unset($pdo);
    return $lesNewsLetters;
}
