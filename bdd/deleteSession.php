<?php
/**
* deleteSession
* Supprimer la session dont l'id est passé en paramètre
*
* @param string $id
*
* @return bool true si la suppression est effectuée, ou false sinon
*/
function deleteSession($id)
{
    $pdo = connectBDD();
    $ret = false;
    $sql="delete from session where id=:id";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $ret = $stmt->execute();
    }  catch (PDOException $e) {
        header('Content-Type: text/html; charset=latin-1');
        die ("Erreur deleteSession (sessions): " . $e->getMessage() .
        " - Ligne " . $e->getLine());
    }
    return $ret;
}