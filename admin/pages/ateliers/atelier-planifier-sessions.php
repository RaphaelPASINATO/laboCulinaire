<?php
session_start();
if (isset($_SESSION['login']) == false) {
    header("Location:../login/connexion.php");
    exit;
}
include_once("../../../includes/inc-fonctions.php");
include_once("../../../bdd/connectBDD.php");
include_once("../../../bdd/getUnAtelier.php");
include_once("../../../bdd/getSessionsParAtelier.php");
include_once("../../../bdd/insertSession.php");

$idAtelier = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (is_null($idAtelier) || $idAtelier === false) {
    header("Location:../erreurs-http/400.php");
    exit;
}

$atelier = getUnAtelier($idAtelier);
if ($atelier === false){
    header("Location:../erreurs-http/404.php");
    exit;
}

$lesSessions = getSessionsParAtelier($idAtelier);
        
if (count($_POST) > 0) {
    include_once("inc-valid-planifier-sessions.php");
}

        $intitule = $atelier->intitule;
        $accroche = $atelier->accroche;
        $duree = $atelier->duree;
        $prixParPersonne = $atelier->prixParPersonne;
        $nbPersonnesMin = $atelier->nbPersonnesMin;
        $nbPersonnesMax = $atelier->nbPersonnesMax;
        $idCategorie = $atelier->idCategorie;
        $description = $atelier->description;

?>
<!DOCTYPE html>
<html lang="fr">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LaboCulinaire - Planification sessions d'un atelier</title>
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
                    <li class="breadcrumb-item active">Planifier sessions</li>
                </ol>

                <h1>Planification sessions atelier n° <?php echo $idAtelier;?> </h1>
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
                <section id="infos-atelier" class="mt-3">
                    <div class="form-group row">
                        <label for="intitule" class="col-sm-1 col-form-label">Intitulé</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="intitule" value="<?php echo htmlspecialchars($intitule);?>"readonly >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="accroche" class="col-sm-1 col-form-label">Durée</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="intitule" value="<?php echo $duree;?>H00" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="mini" class="col-sm-1 col-form-label">Nb pers.</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="mini" value="<?php echo $nbPersonnesMin;?> MIN / <?php echo $nbPersonnesMax;?> MAX" readonly >

                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="prix" class="col-sm-1 col-form-label">Prix</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="prix" value="<?php echo $prixParPersonne;?> €  PAR PERS" readonly >
                        </div>
                    </div>
                </section>

                <section id="liste-sessions" class="mt-3">
                    <h3>Les sessions planifiées</h3>
                    <table id="tb-sessions "class="table w-50">
                        <tr>
                            <th>Date</th>
                            <th>Heure</th>
                            <th>Suppr</th>
                        </tr>
                        <?php
                        $lesSessions = getSessionsParAtelier($atelier->id, 0);
                        foreach ($lesSessions as $session) {
                            $date =dateAnglaisVersFrancaisFormatLong($session->dateSession);
                            $heure =timeVersHeure($session ->heureDebut);
                            echo "<tr>";
                            echo"<td>$date</td>";
                            echo"<td>$heure</td>";
                            echo "<td>";
                            echo "<form action='valid-supprimer-session.php' method='post'>";
                            echo '<input type="hidden" name="token" value="'.$_SESSION['token']  .'">';
                            echo "<input type='hidden' name='id' value='" . $session->id . "'>";
                            echo "<input type='hidden' name='idAtelier' value='" . $idAtelier . "'>";
                            echo "<button type='submit' class='btn btn-link p-0'><i class='far fa-trash-alt'></i></button>";
                            echo "</form>";
                            echo "</td>";
                            echo"</tr>";
                        }
                        ?>
                    </table>
                </section>

                <section id="form-saisie-session" class="mt-3"novalidate>
                    <h3>Ajout nouvelle session</h3>

                    <form action="" method="post" class="w-50">
                    <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
                        <div class="form-row align-items-center">
                            <div class="col-auto">
                                <input type="date" class="form-control mb-2" id="dateSession" name="dateSession">
                            </div>
                            <div class="col-auto">
                                <input type="time" class="form-control" id="heureDebut" name="heureDebut">
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary mb-2">Ajouter</button>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
            <!-- /.container-fluid -->

            <!-- Sticky Footer -->
            <!-- <?php include_once("../../includes/inc-footer.html"); ?> -->

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