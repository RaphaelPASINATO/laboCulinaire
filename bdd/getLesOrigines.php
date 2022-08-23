<?php

/**
 * getLesOrigines
 * permet de faire apparaitre la liste des origines
 * @return table une table qui continent les origines
 */
function getLesOrigines()
{
    $pdo = connectBDD();
    $lesOrigines = [];

    $sql = "select *
from origine";
    try {
        $stmt = $pdo->query($sql);
        $lesOrigines = $stmt->fetchAll();
        $stmt->closeCursor();
    } catch (PDOException $e) {
        header('Content-Type: text/html; charset=latin-1');
        die("Erreur getlesOrigines : " . $e->getMessage() .
            " - Ligne " . $e->getLine());
    }
    unset($pdo);
    return $lesOrigines;
}
