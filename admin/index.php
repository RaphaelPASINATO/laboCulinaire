<?php
session_start();
if (isset($_SESSION['login']) == false) {
header("Location:pages/login/connexion.php");
exit;
}
header("Location:pages/accueil/index.php");
exit;