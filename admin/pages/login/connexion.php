<?php
include_once("../../../includes/inc-fonctions.php");
include_once("../../../bdd/connectBDD.php");
include_once("../../../bdd/getInfosUtilsateur.php");
include_once("inc-valid-connexion.php");


?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Connexion</title>
    <link rel="stylesheet" href="../../css/connexion.min.css">
</head>

<body>
    <div class="admin-connexion">
        <h1>Connectez-vous à l'espace d'administration</h1>
        <div class="form-connexion form">
            <div id="login">   
            <?php
            if (count($_POST) > 0) {
                if (count($erreurs) != 0) {
                    echo getListeErreurs($erreurs);
                } else {
                    if (empty($info) == false) {
                        echo $info;
                    }
                }
            }
            ?>
                <form action="" method="post" autocomplete="off" novalidate>
                    <div class="field-wrap">
                        <label> Votre login<span class="req">*</span> </label>
                        <input type="text" name="login" required />
                    </div>
                    <div class="field-wrap">
                        <label> Votre mot de passe<span class="req">*</span> </label>
                        <input type="password" name="password" required />
                    </div>
                    <button type="submit" class="button button-block" />Log In</button>
                </form>
            </div>
        </div>
    </div>
    <script src="../../../vendor/jquery-3.4.1/jquery-3.4.1.min.js"></script>
    <script src="../../js/connexion.min.js"></script>

</body>

</html>