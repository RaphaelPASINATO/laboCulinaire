<?php
session_start();
if (isset($_SESSION['login']) == false) {
    header("Location:../login/connexion.php");
    exit;
}
include_once("../../../includes/inc-fonctions.php");
include_once("../../../bdd/connectBDD.php");
include_once("../../../bdd/getLesNewsletters.php");
include_once("../../../bdd/getLesOrigines.php");
$leslesNewsLetters = getLesNewsLetters();
$lesOrigines = getLesOrigines();

?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LaboCulinaire - Gérer les demandes de newsletters</title>
    <link href="../../../images/favicon.ico" rel="shortcut icon" type="image/x-icon">
    <link href="../../../images/favicon.ico" rel="icon" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i,900">
    <link href="../../../vendor/bootstrap-4.3.1/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../../../vendor/fontawesome-5.10.2-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../../../vendor/datatables-1.10.19/dataTables.bootstrap4.css" rel="stylesheet" type="text/css">
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
                    <li class="breadcrumb-item active">Newsletters</li>
                </ol>

                <h1>Gérer les demandes de newsletters</h1>

                <?php
                $_SESSION['token'] = genereToken();
                $_SESSION['token_time'] = time();
                ?>


                <div class="table-responsive my-5">
                    <table class="table table-bordered dataTable" id="liste-ateliers">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Mail</th>
                                <th>H/F</th>
                                <th>Actus</th>
                                <th>Recettes</th>
                                <th>Offres</th>
                                <th>Origine</th>
                                <th>Question</th>
                                <th>Validée</th>
                                <th class="no-sort">Maj</th>
                                <th class="no-sort">Sup</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($leslesNewsLetters as $newsletter){
                            $idun = $newsletter->idOrigine;
                            echo "<tr>";
                            echo "<td>$newsletter->id</td>";
                            echo '<td>' . htmlspecialchars($newsletter->mail) . '</td>';
                            echo '<td>' . htmlspecialchars($newsletter->genre) . '</td>';
                            $croix = "";
                            if ($newsletter->actus == 1){
                                $croix ="X";
                            }
                            echo "<td>$croix</td>";
                            $croix = "";
                            if ($newsletter->recettes == 1){
                                $croix ="X";
                            }
                            echo "<td>$croix</td>";
                            $croix = "";
                            if ($newsletter->offres == 1){
                                $croix ="X";
                            }
                            echo "<td>$croix</td>";
                            foreach($lesOrigines as $origine){
                                $iddeux = $origine->id;
                                if($idun === $iddeux){
                                    echo '<td>' . htmlspecialchars($origine->libelle) . '</td>';
                                }
                            }
                            echo '<td>' . htmlspecialchars($newsletter->questions) . '</td>';
                            $croix = "";
                            if ($newsletter->valide == 1){
                                $croix ="X";
                            }
                            echo"<td>$croix</td>";
                            echo'<td> <a class="nav-link" href="../../../admin/pages/newsletters/newsletter-modifier.php?id='. $newsletter->id;
                            echo'"><i class="fas fa-fw fa-edit"></i></a></td>';
                            echo'<td><a href="#" data-id="' . $newsletter->id . '" class="openDialog" data-toggle="modal"
                            data-target="#deleteNewsletterModal" title="Supprimer"><i class="far fa-trash-alt"></i></a></td>';
                            echo"</tr>";
                        }
                        ?>
                        </tbody>
                    </table>

                </div>
            </div>
            <!-- /.container-fluid -->

            <?php include_once("../../includes/inc-footer.html"); ?>

        </div>
        <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Modale suppression newsletter -->
    <div class="modal fade" id="deleteNewsletterModal" role="dialog" aria-labelledby="deleteNewsletterModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteNewsletterModalLabel">Suppression de la newsletter n° <span id="idNewsletter"></span></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body"> Etes-vous certain ? </div>
                <div class="modal-footer">
                    <form id="form-delete" action='valid-newsletter-supprimer.php' method='post'>
                    <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
                        <input type="hidden" id="id" name="id">
                        <button class="btn btn-light" type="button" data-dismiss="modal">Annuler</button>
                        <!-- A T T E N T I O N   N E C E S S I T E   J A V A S C R I P T   S U R   B O U T O N   S U B M I T -->
                        <button class="btn btn-danger" type="button" onclick="document.getElementById('form-delete').submit();" data-dismiss="modal">Confirmer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </form>

    <!-- Logout Modal-->
    <?php include_once("../../includes/inc-logout-modal.html"); ?>


    <script src="../../../vendor/jquery-3.4.1/jquery-3.4.1.min.js"></script>
    <script src="../../../vendor/bootstrap-4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="../../../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../../../vendor/datatables-1.10.19/jquery.dataTables.js"></script>
    <script src="../../../vendor/datatables-1.10.19/dataTables.bootstrap4.js"></script>
    <script src="../../js/admin.min.js"></script>
    <script src="../../js/datatables.js"></script>
     <script>
        $(function() {
            $(".openDialog").click(function() {
                var idNewsletter = $(this).data('id');
                $('#id').val(idNewsletter);
                $("#idNewsletter").empty().html(idNewsletter);
            });
        });
    </script>
</body>

</html>