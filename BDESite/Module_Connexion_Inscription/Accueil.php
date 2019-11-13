<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="css/fonction.css">
        <title>Acceuil</title>
</head>
<body onload="<div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
<div class="modal-dialog" role="document">
 <div class="modal-content">
  <div class="modal-header">
   <h5 class="modal-title" id="exampleModalLabel">Consentement sur l'utilisation de cookie</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
     <span aria-hidden="true">&times;</span>
    </button>
  </div>
   <div class="modal-body">
   <p>En naviguant sur notre site, vous accepter l'utilisation de cookie de type marketing pour permettre 
   une expérience plus enrichissante lors de votre visite.
   </div>
    <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Autres Options</button>
    <button type="submit" name="Cookiebtn" class="btn btn-primary">Accepter</button>
   </div>
 </div>
</div>
</div>">
<?php 
include 'ScriptAccueil.php'; 

if(isset($_POST['Cookiebtn']))
{
    $_SESSION['user_id'] = $id;
    $req1 = $bdd->prepare('SELECT MAIL FROM `users` WHERE ID = :id');
    $req1->execute(array(
        'id' => $id));  
    $resultat = $req1->fetch();

    $cookie_value=$resultat['MAIL'];
    setcookie('user',$cookie_value, time() + 5*365*24*3600, null, null, false, true); //cookie pour une durée de cinq ans
    echo $resultat; 
} 
?>


    <header>
        <!--en tête-->
        <!--menu-->
        <?php require_once("../elements/menu.php") ?>
    </header>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <!--corps du site-->
   


    
    <footer>
        <?php require_once("../elements/footer.php") ?>
        <!--pied de page-->
    </footer>
</body>
</html>