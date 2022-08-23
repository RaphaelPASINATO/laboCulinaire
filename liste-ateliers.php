<?php
include_once("bdd/connectBDD.php");
include_once("bdd/getLesCategories.php");

$lesCategories = getLesCategories();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Le labo culinaire</title>
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i,900" rel="stylesheet">
    <link rel="stylesheet" media="screen" href="vendor/bootstrap-4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/fontawesome-5.10.2-free/css/all.min.css">
    <link rel="stylesheet" media="screen" href="css/styles.min.css">

    <style>
        #header-bottom {
            background: url(images/bg-small-2.jpg) no-repeat;
            background-size: cover;
        }
    </style>
</head>

<body>
    <header id="header-small">
        <?php include_once("includes/inc-header.html"); ?>
    </header>

    <section id="atelier" class="fond-clair py-5 px-1 px-lg-3 px-xl-5">
        <h1 class="text-center">Les ateliers du moment </h1>

        <div id="filtre-cours">
            <div class="mb-4 text-center">
                <a class="btn btn-dark" data-toggle="collapse" href="#criteres" role="button" aria-expanded="false" aria-controls="criteres">Filtrer</a>
            </div>
            <div id="criteres" class="collapse">
                <form action="" method="post">
                    <div class="row">
                        <div class="col">
                            <label for="filtre-categorie">Catégorie</label>
                            <select class="form-control" id="filtre-categorie" name="idCategorie">
                                <option value=''>--- Choisir ----</option>
                                <?php
                                foreach ($lesCategories as $categorie) {
                                    if (isset($idCategorie) && $idCategorie == $categorie->id) {
                                        echo "<option value='$categorie->id'>" . htmlspecialchars($categorie->libelle) . "</option>";
                                    } else {
                                        echo "<option value='$categorie->id'>" . htmlspecialchars($categorie->libelle) . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col">
                            <label for="filtre-date-fin">Prix max</label>
                            <input type="input" class="form-control" id="filtre-prix" name="filtrePrix">
                        </div>
                        <div class="col">
                            <label for="filtre-date-debut">Date début</label>
                            <input type="date" class="form-control" id="filtre-date-debut" name="filtreDateDebut">
                        </div>
                        <div class="col">
                            <label for="filtre-date-fin">Date fin</label>
                            <input type="date" class="form-control" id="filtre-date-fin" name="filtreDateFin">
                        </div>
                        <div class="col d-flex align-items-end">
                            <button class="btn btn-outline-dark d-inline" id="effacer-filtres" name="effacer-filtres">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div id="liste-ateliers" class="d-flex flex-wrap justify-content-center">

        </div>
    </section>
    <?php include_once("includes/inc-footer.html"); ?>

    <!-- jQuery -->
    <script src="vendor/jquery-3.4.1/jquery-3.4.1.min.js"></script>
    <script src="vendor/bootstrap-4.3.1/js/bootstrap.min.js"></script>
    <script src="js/ateliers.min.js"></script>
    <script src="js/liste-ateliers.js"></script>

</body>

</html>