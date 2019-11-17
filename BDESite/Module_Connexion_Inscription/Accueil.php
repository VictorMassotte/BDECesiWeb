<?php
session_start();
require_once('../boutique/bdd.php');
if(isset($_SESSION['login'])){
    
}else{
    header('Location: http://localhost/BDECesiWeb/BDESite/Module_Connexion_Inscription/Connexion.php');
}
?>
 

<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <title>Acceuil</title>
        <!--Boucle qui permet de faire apparaître un popup au chargement de la page puis de le refermer lors du click sur son bouton Accepter-->
        <?php if (isset($_COOKIE['user'])){?>
            <script> $(document).ready(function(){ 
        $('#exampleModal').modal('hide');
        });  
        </script>
        <?php }else{ ?>
        <script> $(document).ready(function(){ 
        $('#exampleModal').modal('show');
        });  
        </script>
        <?php }?>
</head>
<body id="monbody">
<!--Popup-->
<form method="POST" action="ScriptAccueil.php">
<div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
<div class="modal-dialog" id="customPopup" role="document">
 <div class="modal-content">
  <div class="modal-header">
   <h5 class="modal-title" id="exampleModalLabel">Consentement sur l'utilisation de cookie</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
     <span aria-hidden="true">&times;</span>
    </button>
  </div>
   <div class="modal-body">
   <p>
En naviguant sur notre site, vous acceptez l'utilisation de cookies de type marketing pour permettre 
   une expérience plus enrichissante lors de votre visite.</p>
   </div>
    <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Autres Options</button>
    <button type="submit" name="Cookiebtn"  class="btn btn-primary">Accepter</button>
   </div>
 </div>
</div>
</div>
</form>
    <header>
        <!--en tête-->
        <!--menu-->
        <?php 
        require_once("../boutique/bdd.php");
        require_once("../elements/menu.php"); ?>
    </header>

    <main>
        <br>
    <center><h1>Bureau des Eleves du CESI</h1></center>
<br>
<div class="card mb-5 testhidden" style="max-width: 1920px;">
        <div class="row no-gutters">
            <div class="col-md-4">
            <img src="https://paris.cesi.fr/wp-content/uploads/sites/18/2018/11/Page30_Mascotte_BDE.jpg" class="card-img" alt="Image Groupe BDE">
            </div>
            <div class="col-md-8">
            <div class="card-body">
            <h2>BDE Campus Nanterre</h2>
                <p>Le BDE du Campus de Nanterre est une association d’apprenants provenant des différentes écoles du campus avec pour objectif de les fédérer au sein de l’établissement. Les missions principales sont, entre autres, la coordination entre ses représentants, les apprenants ainsi que la direction.<p>
                <p>Au sein du BDE, nous retrouvons différents clubs : </p> 
                <ul>
                    <li>Club CESI Photos/Vidéos
                    <li>CESI Voile
                    <li>CESI Palace (jeux de cartes)
                    <li>CESI Boxe
                    <li>CESI Basket-Ball
                    <li>Césième
                    <li>CESI Espadon (natation)
                    <li>CESI Culture  
                    <li>CESI Rugby 
                    <li>CESI Foot
                    <li>CESI LSF (Langue des Signes) 
                    <li>CESI Pétanque 
                    <li>CESI Workout
                    <li>CESI Aide
                    <li>CESI’k
                    <li>CESI Ton Entreprise
                    <li>CESI Manga.
                </ul>
                <p>Vous souhaitez participer au BDE ? Vous avez un projet ou des questions sur son fonctionnement ?</p>
                <center><a class="btn btn-primary" href="http://localhost/BDECesiWeb/BDESite/Contact/contact.php" role="button">Nous contacter</a></center> 
            </div>
            </div>
        </div>
        </div>


    </main>
    <!--corps du site-->
    <footer>
        <?php require_once("../elements/footer.php") ?>
        <!--pied de page-->
    </footer>
</body>
</html>
