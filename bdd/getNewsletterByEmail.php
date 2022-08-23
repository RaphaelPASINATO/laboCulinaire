<?php
/**
 * getNewsletterByEmail
 * Retourne sous forme d'un entier un id correspondant à l'adresse mail
 * @param string $mail
 * 
 * @return int retourne un id correspondant à l'email ou null si le mail n'existe pas.
 */
function getNewsletterByEmail($mail)
{
    $pdo = connectBDD();

    $id = null;

    $sql="select *
        from newsletter
        where newsletter.mail =:mail";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':mail', $mail);
        $stmt->execute();
        $newsletter = $stmt->fetch();
        if ($newsletter != false) {
        $id = $newsletter->id;
        $stmt->closeCursor();
        }
    } catch (PDOException $e) {
        header('Content-Type: text/html; charset=latin-1');
        die ("Erreur getNewsletterByEmail : " . $e->getMessage(). " - Ligne " . $e->getLine());
    }

    unset($pdo);

    return $id;
}
