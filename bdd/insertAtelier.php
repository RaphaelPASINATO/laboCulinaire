<?php
/**
* insertAtelier
* Ajoute un nouveau atelier dans la base de données
*
* @param string $intitule le nom de l'atelier
* @param string $accroche une phrase d'accroche correspondant à l'atelier
* @param int $duree la duree de l'atelier en heure
* @param int $nbPersonnesMin le nombre de personne minimum dans l'atelier
* @param int $nbPersonnesMax le nombre de personne maximum dans l'atelier
* @param float $prixParPersonne un réel contenant le prix de l'atelier pour une personne
* @param int $idCategorie identifiant de la categorie de l'atelier
* @param string $description un string contenant la description de l'atelier
*
* @return mixed identifiant de l'atelier ajouté, ou false en cas d'erreur
*/
function insertAtelier($intitule, $accroche, $duree, $nbPersonnesMin, $nbPersonnesMax, $prixParPersonne, $idCategorie, $description) {
    $pdo = connectBDD();
    $ret = false;
    $sql = "insert into atelier (intitule, accroche, duree, nbPersonnesMin, 
            nbPersonnesMax, prixParPersonne, idCategorie, description) values (:intitule, :accroche,
            :duree, :nbPersonnesMin, :nbPersonnesMax, :prixParPersonne, :idCategorie, :description)";
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':intitule', $intitule);
            $stmt->bindParam(':accroche', $accroche);
            $stmt->bindParam(':duree', $duree);
            $stmt->bindParam(':nbPersonnesMin', $nbPersonnesMin);
            $stmt->bindParam(':nbPersonnesMax', $nbPersonnesMax);
            $stmt->bindParam(':prixParPersonne', $prixParPersonne);
            $stmt->bindParam(':idCategorie', $idCategorie);
            $stmt->bindParam(':description', $description);
            // il faut démarrer une transaction
            $pdo->beginTransaction();
            if ($stmt->execute()) {
            $ret = $pdo->lastInsertId(); // récupère l’id
            }
            $pdo->commit(); // indispensable après un beginTransaction
            } catch (PDOException $e) {
            if ($pdo) {
            $pdo->rollBack(); // annule la transaction si problème
            }


        } catch (PDOException $e) {
            header('Content-Type: text/html; charset=latin-1');
            die("Erreur insertAtelier : " . $e->getMessage() . " - Ligne " . $e->getLine());
        }
    unset($pdo);
    return $ret;
}