<?php 
session_start();
require_once('bdd.php');


if(isset($_SESSION['membre_BDE'])){
    
}elseif((isset($_SESSION['etudiant'])) || (isset($_SESSION['intervenant_CESI']))){
    header('Location: http://localhost/BDECesiWeb/BDESite/Module_Connexion_Inscription/Accueil.php');

}else{
    header('Location: http://localhost/BDECesiWeb/BDESite/Module_Connexion_Inscription/Connexion.php');
}


?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/jumbotron/">
    <script src="../js/jquery-3.4.1.min.js"></script>
    <link href="../style/boutique.css" rel="stylesheet">
    
    <title>Menu Admin Boutique</title>
</head>

<?php include('../../elements/menu.php'); ?>

<body>
    
    <main>
        <div class="jumbotron">
            <br><br><br> <h1 class="display-4">Panel Administration de la Boutique</h1>
        </div>
        <!--les boutons-->
            <div class="text-center" style="margin-bottom: 187px;margin-top: 100px;">
                <div class="btn-group">
                  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Les articles
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="AjoutArticle.php">Ajouter un article</a>
                    <a class="dropdown-item" href="visu.php">Modifier / Supprimer un article</a>
                  </div>
                </div>
                    <!--autre bouton problème de différentiation des deux dropdown le premier prévalois sur le second-->
                <div class="btn-group"> 
                  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Les catégories
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="addcategorie.php">Ajouter une catégorie</a>
                    <a class="dropdown-item" href="edit_deletecategorie.php">Modifier / Supprimer une catégorie</a>
                  </div>
                </div>
            </div>
        <div>
    </main>
    <?php require_once('../../elements/footer.php'); ?>
</body>
</html>
<style>
    .test{
    overflow:hidden;
    }

</style>






