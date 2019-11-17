<?php
session_start();
require_once('../boutique/bdd.php');

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
    <link href="../style/boutique.css" rel="stylesheet">
    
    <title>Menu Admin Boutique</title>
</head>

<?php include('../elements/menu.php'); ?>

<body>
    
    <main>
        <div class="jumbotron">
            <br><br><br> <h1 class="display-4">Panel Administration des manifestations</h1>
        </div>
        <!--les boutons-->
            <div class="text-center" style="margin-bottom: 187px;margin-top: 100px;">
                <div class="btn-group">
                  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Manifestation
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="ajoutManifestation.php">Poster une manifestation</a>
                    <a class="dropdown-item" href="membreInscrits.php">Lister les membres inscrits à une manifestation</a>
                  </div>
                </div>
                    <!--autre bouton problème de différentiation des deux dropdown le premier prévalois sur le second-->
                <div class="btn-group"> 
                  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Suppression
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="suppPhoto.php">Supprimer une photo</a>
                    <a class="dropdown-item" href="supprimerCommentaireManif.php">Supprimer un commentaire</a>
                    <a class="dropdown-item" href="suppCommentairePhoto.php">Supprimer un commentaire d'une photo</a>
                  </div>
                </div>
            </div>
        <div>
    </main>
    <?php require_once('../elements/footer.php'); ?>
</body>
</html>
