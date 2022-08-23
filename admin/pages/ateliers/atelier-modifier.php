<!DOCTYPE html>
<html lang="fr">

<head>
    <?php
    session_start();
    if (isset($_SESSION['login']) == false) {
        header("Location:../login/connexion.php");
        exit;
    }
    include_once("../../../includes/inc-fonctions.php");
    include_once("../../../bdd/connectBDD.php");
    include_once("../../../bdd/getUnAtelier.php");
    include_once("../../../bdd/getLesCategories.php");
    include_once("../../../bdd/updateAtelier.php");

    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    if (is_null($id) || $id === false) {
        header("Location:../erreurs-http/400.php");
        exit;
    }
    $lesCategories = getLesCategories();

    if (count($_POST) == 0) {
        $atelier = getUnAtelier($id);
        if ($atelier === false) {
            header("Location:../erreurs-http/404.php");
            exit;
        }
        $intitule = $atelier->intitule;
        $accroche = $atelier->accroche;
        $duree = $atelier->duree;
        $prixParPersonne = $atelier->prixParPersonne;
        $nbPersonnesMin = $atelier->nbPersonnesMin;
        $nbPersonnesMax = $atelier->nbPersonnesMax;
        $idCategorie = $atelier->idCategorie;
        $description = $atelier->description;
    }

    if (count($_POST) > 0) {
        include_once("inc-valid-modifer-atelier.php");
    }
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LaboCulinaire - Modification atelier</title>
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
                        <a href="../ateliers/ateliers-liste.php">Ateliers</a>
                    </li>
                    <li class="breadcrumb-item active">Modification atelier</li>
                </ol>

                <h1>Modifier atelier n° <?php echo $id; ?> </h1>

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
                        <label for="intitule">Intitulé</label>
                        <input type="text" class="form-control" id="intitule" name="intitule" value="<?php echo htmlspecialchars($intitule); ?>" required>
                        <input type="hidden">
                    </div>
                    <div class="form-group">
                        <label for="accroche">Accroche</label>
                        <input type="text" class="form-control" id="accroche" name="accroche" value="<?php echo htmlspecialchars($accroche); ?>" required>
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
                            <input type="text" class="form-control" id="duree" name="duree" value="<?php echo $duree; ?>" required>
                        </div>
                        <div class="form-group col-md-6 col-lg-3">
                            <label for="prix">Prix/personne</label>
                            <input type="text" class="form-control" id="prixParPersonne" name="prixParPersonne" value="<?php echo $prixParPersonne; ?>" required>
                        </div>
                        <div class="form-group col-md-6 col-lg-3">
                            <label for="mini">Nb personnes mini</label>
                            <input type="text" class="form-control" id="nbPersonnesMin" name="nbPersonnesMin" value="<?php echo $nbPersonnesMin; ?>" required>
                        </div>
                        <div class="form-group col-md-6 col-lg-3">
                            <label for="maxi">Nb personnes maxi</label>
                            <input type="text" class="form-control" id="nbPersonnesMax" name="nbPersonnesMax" value="<?php echo $nbPersonnesMax; ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="10"><?php echo htmlspecialchars($description); ?></textarea>
                    </div>
                    <div id="boutons" class="form-group my-4">
                        <input type="submit" class="btn btn-danger" />
                        <a href="ateliers-liste.php" class="btn btn-light">Annuler</a>
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