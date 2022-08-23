<?php
/**
* insertNewsletter
* Ajoute une nouvelle demande de newsletter dans la base de données
*
* @param string $genre genre de l'internaute (homme ou femme)
* @param string $mail adresse mail de l'internaute
* @param int $actus 1 si la newsletter "Actualités" est souhaitée, 0 sinon
* @param int $offres 1 si la newsletter "Offres et bons plans" est souhaitée, 0 sinon
* @param int $recettes 1 si la newsletter "Recettes de chefs" est souhaitée, 0 sinon
* @param int $questions questions complémentaires de l’internaute
* @param int $idOrigine identifiant de l’origine de la demande de newsletter
*
* @return bool true si la requête s'est exécutée correctement, false sinon
*/
function insertNewsletter($genre, $mail, $actus, $offres, $recettes, $questions, $idOrigine)
{
$pdo = connectBDD();
$ret = false;
$sql = "insert into newsletter(genre, mail, actus, offres, recettes, questions, idOrigine)
values (:genre,:mail,:actus,:offres,:recettes,:questions,:idOrigine)";
$stmt = $pdo->prepare($sql);
try {
    $stmt->execute([
        ':genre' => $genre,
        ':mail' => $mail,
        ':actus' => $actus,
        ':offres' => $offres,
        ':recettes' => $recettes,
        ':questions' => $questions,
        ':idOrigine' => $idOrigine,
    ]);
} catch (PDOException $e) {
header('Content-Type: text/html; charset=latin-1');
die("Erreur insertNewsletter : " . $e->getMessage() . " - Ligne " . $e->getLine());
}
unset($pdo);
return $ret;
}
