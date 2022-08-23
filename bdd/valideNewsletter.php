<?php

/**
 * valideNewsletter
 * Sert a valider ou pas une newsletter.
 *
 * @param int $id nombre identifiant du newsletter
 * @param int $valide 1 si la newsletter est validéé, 0 sinon
 *
 * @return bool true si la requête s'est exécutée correctement, false sinon
 */
function valideNewsletter($id, $valide)
{
    $pdo = connectBDD();
    $ret = false;
    $sql = "UPDATE  newsletter
            set valide =:valide
            where id = :id";
    $stmt = $pdo->prepare($sql);
    try {
        $stmt->execute([
            ':valide' => $valide,
            ':id' => $id,
        ]);
    } catch (PDOException $e) {
        header('Content-Type: text/html; charset=latin-1');
        die("Erreur valideNewsletter : " . $e->getMessage() . " - Ligne " . $e->getLine());
    }
    unset($pdo);
    return $ret;
}
