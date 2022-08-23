<?php

/**
 * getUnNewsletter
 * Retourne sous forme d'un objet les informations de l'atelier dont
 * l'identifiant est passé en paramètre ainsi que le nom de la catégorie
 * 
 * @param int $id
 * 
 * @return mixed objet contenant les informations de l'atelier ou false
 */
function getUnNewsletter($id)
{
    $pdo = connectBDD();

    $leNewsletter = false;

    $sql="select *
        from newsletter
        where newsletter.id =:id";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $leNewsletter = $stmt->fetch();
        $stmt->closeCursor();
    } catch (PDOException $e) {
        header('Content-Type: text/html; charset=latin-1');
        die ("Erreur getUnNewsletter : " . $e->getMessage(). " - Ligne " . $e->getLine());
    }

    unset($pdo);

    return $leNewsletter;
}
