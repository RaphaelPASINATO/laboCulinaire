<?php
session_start();
if (isset($_SESSION['login']) == false) {
    header("Location:../login/connexion.php");
    exit;
}
include_once("../../../includes/inc-fonctions.php");
include_once("../../../bdd/connectBDD.php");
include_once("../../../bdd/getLesOrigines.php");
include_once("../../../bdd/getUnNewsletter.php");
include_once("../../../bdd/valideNewsletter.php");

$lanews =
    $lesOrigines = getLesOrigines();
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (is_null($id) || $id === false) {
    header("Location:../erreurs-http/400.php");
    exit;
}

if (count($_POST) == 0) {
    $newsletter = getUnNewsletter($id);
    if ($newsletter === false) {
        header("Location:../erreurs-http/404.php");
        exit;
    }
    $genre = $newsletter->genre;
    $mail = $newsletter->mail;
    $actus = $newsletter->actus;
    $offres = $newsletter->offres;
    $recettes = $newsletter->recettes;
    $questions = $newsletter->questions;
    $valide = $newsletter->valide;
    $idOrigine = $newsletter->idOrigine;
}

if (count($_POST) > 0) {
    include_once("inc-valid-modifier-newsletter.php");
}
?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LaboCulinaire - Validation newsletter</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i,900">
    <link href="../../../images/favicon.ico" rel="shortcut icon" type="image/x-icon">
    <link href="../../../images/favicon.ico" rel="icon" type="image/x-icon">
    <link href="../../../vendor/bootstrap-4.3.1/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../../../vendor/fontawesome-5.10.2-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../../css/admin.min.css" rel="stylesheet">
</head>

<body id="page-top">
    <?php include_once("../../includes/inc-navbar.php"); ?>

    <div id="wrapper">
        <?php include_once("../../includes/inc-sidebar.php"); ?>

        <div id="content-wrapper">

            <div class="container-fluid">

                <!-- Fil d'Ariane-->
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="../../index.php">Accueil</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="../newsletters/newsletters-liste.php">Newsletters</a>
                    </li>
                    <li class="breadcrumb-item active">Modification newsletter</li>
                </ol>
                <h1>Validation newsletter n° <?php echo $id; ?></h1>


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

                $_SESSION['token'] = genereToken();
                $_SESSION['token_time'] = time();
                ?>

                <form action="" method="post">
                    <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
                    <div class="form-group">
                        <div class="row">
                            <label class="col-form-label col-sm-2 pt-0">Genre</label>
                            <div class="col-sm-10">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="homme" name="genre" disabled value="homme" <?php if (isset($genre) && $genre == "homme") {
                                                                                                                                    echo htmlspecialchars('checked');
                                                                                                                                } ?>>
                                    <label class="form-check-label" for="monsieur">Homme</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="femme" name="genre" disabled value="femme" <?php if (isset($genre) && $genre == "femme") {
                                                                                                                                    echo htmlspecialchars('checked');
                                                                                                                                } ?>>
                                    <label class="form-check-label" for="madame">Femme</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="mail">E-mail</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" id="mail" name="mail" value="<?php echo htmlspecialchars($mail); ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label class="col-form-label col-sm-2 pt-0">Newsletters</label>
                            <div class="col-sm-10">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="actus" name="actus-aff" disabled value="1" <?php if (isset($actus) && $actus == 1) {
                                                                                                                                        echo htmlspecialchars('checked');
                                                                                                                                    } ?>>
                                    <label class="form-check-label" for="actus">L'actualité des ateliers cuisine (mensuel)</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="offres" name="offres-aff" disabled value="1" <?php if (isset($offres) && $offres == 1) {
                                                                                                                                            echo htmlspecialchars('checked');
                                                                                                                                        } ?>>
                                    <label class="form-check-label" for="offres">Les offres et bons plans du moment ! (occasionnel)</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="recettes" name="recettes-aff" disabled value="1" <?php if (isset($recettes) && $recettes == 1) {
                                                                                                                                                echo htmlspecialchars('checked');
                                                                                                                                            } ?>>
                                    <label class="form-check-label" for="recettes">3 idées recettes de Chefs (hebdomadaire)</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    foreach ($lesOrigines as $origine) {
                        $iddeux = $origine->id;
                        if ($idOrigine === $iddeux) {
                            $origin = $origine->libelle;
                        }
                    }
                    ?>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="libelleOrigine">Origine</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" id="libelleOrigine" name="libelleOrigine" value="<?php echo htmlspecialchars($origin); ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="questions">Des questions ?</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="questions" name="questions" readonly><?php echo htmlspecialchars($questions); ?></textarea>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="row">
                            <label class="col-form-label col-sm-2 pt-0">Validée</label>
                            <div class="col-sm-10">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="valide" name="valide" value="1" <?php if (isset($valide) && $valide == 1) {
                                                                                                                            echo 'checked';
                                                                                                                        } ?>>
                                    <label class="form-check-label" for="valide">Oui</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="nonvalide" name="valide" value="0" <?php if (isset($valide) && $valide == 0) {
                                                                                                                            echo 'checked';
                                                                                                                        } ?>>
                                    <label class="form-check-label" for="nonvalide">Non</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10">
                            <input type="submit" class="btn btn-danger" />
                            <a href="newsletters-liste.php" class="btn btn-light">Annuler</a>
                        </div>
                    </div>
                </form>

            </div>
            <!-- /.container-fluid -->

            <!-- Sticky Footer -->
            <?php include_once("../../includes/inc-footer.html"); ?>

        </div>
        <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <?php include_once("../../includes/inc-logout-modal.html"); ?>

    <script src="../../../vendor/jquery-3.4.1/jquery-3.4.1.min.js"></script>
    <script src="../../../vendor/bootstrap-4.3.1/js/bootstrap.js"></script>
</body>

</html>