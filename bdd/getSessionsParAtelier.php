<?php
/**
* getSessionsParAtelier
* Retourne sous forme d'un tableau d'objets les sessions prévues pour
* l'atelier dont l'identifiant est passé en paramètre
*
* @param int $idAtelier identifiant de l'atelier
* @param int $n nombres de sessions à extraire (0 pour toutes)
*
* @return array tableau d'objets
*/
function getSessionsParAtelier($idAtelier, $n = 0)
{
$pdo = connectBDD();
$lesSessions = [];
if ($n == 0) {
$sql="SELECT * from session
WHERE idAtelier =:atelier
ORDER BY dateSession, heureDebut";
}
else {
$sql="SELECT * from session
 WHERE idAtelier =:atelier
 ORDER BY dateSession, heureDebut
 LIMIT $n";
}
try {
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':atelier', $idAtelier);
$stmt->execute();
$lesSessions = $stmt->fetchAll();
$stmt->closeCursor();
} catch (PDOException $e) {
 header('Content-Type: text/html; charset=latin-1');
die("Erreur getSessionsParAtelier : " . $e->getMessage() . " - Ligne " . $e->getLine());
}
unset($pdo);
return $lesSessions;
}