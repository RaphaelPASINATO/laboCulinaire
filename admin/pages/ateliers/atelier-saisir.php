<?php
session_start();
if (isset($_SESSION['login']) == false) {
    header("Location:../login/connexion.php");
    exit;
}
include_once("../../../includes/inc-fonctions.php");
include_once("../../../bdd/connectBDD.php");
include_once("../../../bdd/getLesCategories.php");
include_once("../../../bdd/insertAtelier.php");

$lesCategories = getLesCategories();
if (count($_POST) > 0) {
    include_once("../ateliers/inc-valid-saisir-atelier.php");
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LaboCulinaire - Saisie atelier</title>
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
                    <li class="breadcrumb-item active">Ajout atelier</li>
                </ol>

                <h1>Ajouter un atelier</h1>

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

                <form action="" method="post" novalidate>
                    <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
                    <div class="form-group">
                        <label for="intitule">Intitulé</label>
                        <input type="text" class="form-control" id="intitule" name="intitule" value="<?php if (isset($intitule)) {
                                                                                                            echo htmlspecialchars($intitule);
                                                                                                        } ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="accroche">Accroche</label>
                        <input type="text" class="form-control" id="accroche" name="accroche" value="<?php if (isset($accroche)) {
                                                                                                            echo htmlspecialchars($accroche);
                                                                                                        } ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="idCategorie">Catégorie</label>
                        <select class="form-control" id="idCategorie" name="idCategorie" required>
                            <option value=''>--- Choisir ----</option>
                            <?php
                            foreach ($lesCategories as $categorie) {
                                if (isset($idCategorie) && $idCategorie == $categorie->id) {
                                    echo "<option value='$categorie->id' selected >" . htmlspecialchars($categorie->libelle) . "</option>";
                                } else {
                                    echo "<option value='$categorie->id'>" . htmlspecialchars($categorie->libelle) . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6 col-lg-3">
                            <label for="duree">Durée</label>
                            <input type="text" class="form-control" id="duree" name="duree" value="<?php if (isset($duree)) {
                                                                                                        echo $duree;
                                                                                                    } ?>">
                        </div>
                        <div class="form-group col-md-6 col-lg-3">
                            <label for="prix">Prix/personne</label>
                            <input type="text" class="form-control" id="prixParPersonne" name="prixParPersonne" value="<?php if (isset($prixParPersonne)) {
                                                                                                                            echo $prixParPersonne;
                                                                                                                        } ?>" required>
                        </div>
                        <div class="form-group col-md-6 col-lg-3">
                            <label for="mini">Nb personnes mini</label>
                            <input type="text" class="form-control" id="nbPersonnesMin" name="nbPersonnesMin" value="<?php if (isset($nbPersonnesMin)) {
                                                                                                                            echo $nbPersonnesMin;
                                                                                                                        } ?>" required>
                        </div>
                        <div class="form-group col-md-6 col-lg-3">
                            <label for="maxi">Nb personnes maxi</label>
                            <input type="text" class="form-control" id="nbPersonnesMax" name="nbPersonnesMax" value="<?php if (isset($nbPersonnesMax)) {
                                                                                                                            echo $nbPersonnesMax;
                                                                                                                        } ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="10"><?php if (isset($description)) {
                                                                                                            echo htmlspecialchars($description);
                                                                                                        } ?></textarea>
                    </div>
                    <div id="boutons" class="form-group my-4">
                        <input type="submit" class="btn btn-danger" />
                        <input type="reset" class="btn btn-light" />
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
    <script src="../../../vendor/bootstrap-4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="../../../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../../js/admin.min.js"></script>
</body>

</html>