<!-- Sidebar -->
<?php
include_once("../../../includes/inc-fonctions.php");
include_once("../../../bdd/connectBDD.php");
include_once("../../../bdd/getInfosUtilsateur.php");
$idProfil=2;
$pdo = connectBDD();
$allo=$_SESSION['login'];
$sql="select idProfil
from utilisateur
where login ='$allo'";
$stmt = $pdo->query($sql);
$newsletter = $stmt->fetch();
$idProfil = $newsletter->idProfil;
?>
<ul class="sidebar navbar-nav">
    <li class="nav-item active">
        <a class="nav-link" href="../accueil/index.php">
            <i class="fas fa-home"></i></i>
            <span>Accueil</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="../ateliers/ateliers-liste.php">
            <i class="fas fa-fw fa-table"></i>
            <span>Ateliers</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="../ateliers/atelier-saisir.php">
            <i class="fas fa-fw fa-table"></i>
            <span>Ajout atelier</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="../newsletters/newsletters-liste.php">
            <i class="fas fa-fw fa-table"></i>
            <span>Newsletters</span></a>
    </li>
    <?php
    if ($idProfil == 1){
        echo('<li class="nav-item">');
        echo('  <a class="nav-link" href="../utilisateurs/index.php">');
        echo('      <i class="fas fa-users-cog"></i>');
        echo('      <span>Gestion utilisateurs</span></a>');
        echo('</li>');
    }
    ?>

</ul>