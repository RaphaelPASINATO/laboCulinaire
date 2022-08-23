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

    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    if (is_null($id) || $id === false) {
        header("Location:../erreurs-http/400.php");
        exit;
    }
    $lesCategories = getLesCategories();

    if (count($_POST) >= 0) {
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
        include_once("inc-valid-upload-photos.php");
    }
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LaboCulinaire - Upload photos pour atelier</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i,900">
    <link href="../../../images/favicon.ico" rel="shortcut icon" type="image/x-icon">
    <link href="../../../images/favicon.ico" rel="icon" type="image/x-icon">
    <link href="../../../vendor/bootstrap-4.3.1/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../../../vendor/fontawesome-5.10.2-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../../css/admin.min.css" rel="stylesheet">
    <style>
        img {
            max-width: 200px;
            display: inline-block;
        }
    </style>
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
                    <li class="breadcrumb-item active">Upload de photos</li>
                </ol>
                <h1>Upload de photos pour l'atelier n° <?php echo $id; ?>
                    <!-- TODO Afficher l'id de l'atelier -->
                </h1>

                <?php
                echo "<h2>";
                echo $intitule;
                echo " - ";
                foreach ($lesCategories as $categorie) {
                    if (isset($idCategorie) && $idCategorie == $categorie->id) {
                        echo ($categorie->libelle);
                    }
                }
                echo "</h2>";
                //TODO Afficher l'intitulé de l'atelier et le libellé de sa catégorie
                ?>
                <p>
                    Poids des images : <strong><span class="erreur">100Ko</span></strong> maxi<br>
                    Extensions <strong><span class="erreur">jpg</span></strong> uniquement
                </p>

                <?php

                //TODO Générer un token
                $_SESSION['token'] = genereToken();
                $_SESSION['token_time'] = time();

                //TODO Ajouter le code vérifiant si les images de l'atelier existent ou non
                $existeFicimg = false;
                $path = __DIR__ . "\\..\\..\\..\\images\\ateliers\\";
                $imgAtelier = $path . "img-atelier-" . $atelier->id . ".jpg";
                if (file_exists($imgAtelier)) {
                    $existeFicimg = true;
                }
                $existeFicbg = false;
                $path = __DIR__ . "\\..\\..\\..\\images\\ateliers\\fonds\\";
                $imgBg = $path . "bg-atelier-" . $atelier->id . ".jpg";
                if (file_exists($imgBg)) {
                    $existeFicbg = true;
                }
                ?>

                <form enctype="multipart/form-data" action="" method="post" class="form my-5">
                    <!-- TODO Ajouter un champ caché contenant le token -->
                    <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
                    <input type="hidden" name="MAX_FILE_SIZE" value="100000" />
                    <div class="row">
                        <div class="col-6 d-flex flex-column justify-content-center">
                            <h6>Image pour la liste des ateliers</h6>
                            <div class="custom-file">
                                <input id="ficimg" type="file" name="ficimg" class="custom-file-input" <?php  if(file_exists($imgAtelier)) {echo "disabled";}?> <?php
                                                                                                        //TODO Désactiver le champ de saisie si l'image atelier existe déjà
                                                                                                        ?>>
                                <label for="ficimg" class="custom-file-label text-truncate" >Choisir le fichier ...</label>
                            </div>
                            <div id="erreurs-image">
                                <?php

                                //TODO Afficher les erreurs sur saisie de l'image de l'atelier
                                if (count($_POST) > 0 && count($erreursImageAtelier) > 0){
                                    echo getListeErreurs($erreursImageAtelier);
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-6 d-flex flex-row align-items-center" id="affiche-image">
                            <?php
                            $rep = str_replace("\\", "/", dirname(__FILE__, 1));
                            $img = "../../../images/ateliers/img-atelier-" . $atelier->id . ".jpg";

                            //TODO Afficher l'image de l'atelier, si elle existe
                            ?>
                            <div class="wrapper-cours">
                            <?php 
                            if(file_exists($imgAtelier)) {
                                echo '<img src="'. $img .'" alt="">';
                            }
                            ?>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-6 d-flex flex-column justify-content-center">
                            <h6>Image de fond pour la fiche de l'atelier</h6>
                            <div class="custom-file">
                                <input id="ficbackground" type="file" name="ficbackground" class="custom-file-input" <?php  if(file_exists($imgBg)) {echo "disabled";}?> <?php
                                                                                                                        //TODO Désactiver le champ de saisie si l'image de fond existe déjà 
                                                                                                                        ?>>
                                <label for="ficbackground" class="custom-file-label text-truncate">Choisir le fichier ...</label>
                            </div>
                            <div id="erreurs-image-fond">
                                <?php
                                //TODO Afficher les erreurs sur saisie de l'image de fond de l'atelier
                                if (count($_POST) > 0 && count($erreursImageFond) > 0){
                                    echo getListeErreurs($erreursImageFond);
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-6 d-flex flex-row align-items-center" id="affiche-fond">
                            <?php
                            $rep = str_replace("\\", "/", dirname(__FILE__, 1));
                            $img = "../../../images/ateliers/fonds/bg-atelier-" . $atelier->id . ".jpg";
                            //TODO Afficher l'image de fond de l'atelier, si elle existe
                            ?>
                            <div class="wrapper-cours"><img src="<?php if(file_exists($imgBg)) {echo $img;}; ?> ?>" alt=""></div> <!-- image -->

                        </div>
                    </div>

                    <div>
                        <input type="submit" class="btn btn-danger mt-4 mb-5">
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
    <script src="../../js/upload-photos.js"></script>
</body>

</html>