<?php
require_once('../boutique/admin/bdd.php');
session_start();


/*echo '<div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
<div class="modal-dialog" role="document">
 <div class="modal-content">
  <div class="modal-header">
   <h5 class="modal-title" id="exampleModalLabel">Consentement sur l\'utilisation de cookie</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
     <span aria-hidden="true">&times;</span>
    </button>
  </div>
   <div class="modal-body">
   <p>En naviguant sur notre site, vous accepter l\'utilisation de cookie de type marketing pour permettre 
   une expérience plus enrichissante lors de votre visite.
   </div>
    <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Autres Options</button>
    <button type="submit" name="Cookiebtn" class="btn btn-primary">Accepter</button>
   </div>
 </div>
</div>
</div>';*/

//<script language="javascript"> function hide(){ var l =getElementById("customPopup"); l.close(); }</script>
//<script language="javascript"> function hide(){$("#customPopup").fadeOut('fast', function () { $(this).hide() });}</script> 
//onsubmit="self.close()"

/*$requete1 = $bdd->prepare('SELECT * FROM `users`');
$requete1->execute();
$resultat1 = $requete1->fetch();
$_SESSION['user_id'] = $resultat1['ID'];*/

    
      if(session_status() === PHP_SESSION_ACTIVE)
    {
      if(isset($_POST['Cookiebtn']))
    { 
        $requete = $bdd->prepare('SELECT MAIL FROM `users` WHERE ID = :id');
        $requete->execute(array(
            'id' => $_SESSION['user_id']));  
        $resultat = $requete->fetch();
        $cookie_value=$resultat['MAIL'];
        setcookie('user',$cookie_value, time() + 5*365*24*3600, null, null, false, true); //cookie pour une durée de cinq ans
        header('Location: Accueil.php');
    }
    }
    else {
      
    }
 

?>