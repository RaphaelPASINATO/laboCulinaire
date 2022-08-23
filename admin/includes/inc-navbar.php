<?php
include_once("../../../includes/inc-fonctions.php");
include_once("../../../bdd/connectBDD.php");
include_once("../../../bdd/getInfosUtilsateur.php");
$nom="undeux";
$pdo = connectBDD();
$allo=$_SESSION['login'];
$sql="select nom
from utilisateur
where login ='$allo'";
$stmt = $pdo->query($sql);
$tr = $stmt->fetch();
$nom = $tr->nom;

$stmt->closeCursor();
unset($pdo);
?>
<nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="../accueil/index.php">Labo Culinaire</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar -->

    <div id="profil" class="ml-auto mr-0 mr-md-2 my-2 my-md-0"><?php echo $nom;?></div>
    <ul class="navbar-nav d-none d-md-inline-block form-inline mr-0 mr-md-3 my-2 my-md-0">
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user-circle fa-fw"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="../utilisateurs/profil-modifier.php">Mon profil</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Déconnexion</a>
            </div>
        </li>
    </ul>

</nav>