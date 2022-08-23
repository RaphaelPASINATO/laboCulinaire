<?php

/**
 * getUnAtelier
 * Retourne sous forme d'un objet les informations de l'atelier dont
 * l'identifiant est passé en paramètre ainsi que le nom de la catégorie
 * 
 * @param int $id
 * 
 * @return mixed objet contenant les informations de l'atelier ou false
 */
function getUnAtelier($id)
{
    $pdo = connectBDD();

    $leAtelier = false;

    $sql="select atelier.*, categorie.libelle as libelleCategorie
        from atelier
        join categorie on categorie.id = idCategorie
        where atelier.id =:id";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $leAtelier = $stmt->fetch();
        $stmt->closeCursor();
    } catch (PDOException $e) {
        header('Content-Type: text/html; charset=latin-1');
        die ("Erreur getUnatelier : " . $e->getMessage(). " - Ligne " . $e->getLine());
    }

    unset($pdo);

    return $leAtelier;
}
