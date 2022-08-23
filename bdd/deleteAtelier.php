<?php
/**
* deleteAtelier
* Supprimer l'atelier dont l'id est passé en paramètre
*
* @param string $id
*
* @return bool true si la suppression est effectuée, ou false sinon
*/
function deleteAtelier($id)
{
 $pdo = connectBDD();
 $ret = false;
 $sql="delete from session where idAtelier=:id";
 try {
 $stmt = $pdo->prepare($sql);
 $stmt->bindParam(':id', $id);
 $ret = $stmt->execute();
 $sql2="delete from atelier where id=:id";
 try {
 $stmt = $pdo->prepare($sql2);
 $stmt->bindParam(':id', $id);
 $ret = $stmt->execute();
 } catch (PDOException $e) {
 header('Content-Type: text/html; charset=latin-1');
 die("Erreur deleteAtelier : " . $e->getMessage() .
 " - Ligne " . $e->getLine());
 }
 } catch (PDOException $e) {
 header('Content-Type: text/html; charset=latin-1');
 die ("Erreur deleteAtelier (sessions): " . $e->getMessage() .
 " - Ligne " . $e->getLine());
 }
 return $ret;
}
