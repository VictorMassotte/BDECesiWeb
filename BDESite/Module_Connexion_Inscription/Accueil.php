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
        <link rel="stylesheet" href="css/fonction.css">
        <title>Acceuil</title>
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
    
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <!--corps du site-->
    <footer>
        <?php require_once("../elements/footer.php") ?>
        <!--pied de page-->
    </footer>
</body>
</html>
