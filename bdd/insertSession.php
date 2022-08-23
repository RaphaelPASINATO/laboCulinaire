<?php
/**
* insertSession
* Ajoute une nouvelle session dans la base de données
*
* @param int $idAtelier le numero correspondant à l'atelier
* @param string $dateSession un string contenant la date de la 
* @param string $heureDebut un string contenant l'heure du debut de la session
*
* @return mixed identifiant de l'atelier ajouté, ou false en cas d'erreur
*/
function insertSession($idAtelier, $dateSession, $heureDebut) {
    $pdo = connectBDD();
    $ret = false;
    $sql ="insert into session (idAtelier, dateSession, heureDebut) values(:idAtelier, :dateSession, :heureDebut)";
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':idAtelier', $idAtelier);
            $stmt->bindParam(':dateSession', $dateSession);
            $stmt->bindParam(':heureDebut', $heureDebut);
            $pdo->beginTransaction();
            if ($stmt->execute()) {
            $ret = $pdo->lastInsertId();
            }
            $pdo->commit();
            } catch (PDOException $e) {
            if ($pdo) {
            $pdo->rollBack();
            }
        } catch (PDOException $e) {
            header('Content-Type: text/html; charset=latin-1');
            die("Erreur insertAtelier : " . $e->getMessage() . " - Ligne " . $e->getLine());
        }
    unset($pdo);
    return $ret;        
}
?>