<?php
require_once('../boutique/admin/bdd.php');
session_start();

//<script language="javascript"> function hide(){ var l =getElementById("customPopup"); l.close(); }</script>
//<script language="javascript"> function hide(){$("#customPopup").fadeOut('fast', function () { $(this).hide() });}</script> 
//onsubmit="self.close()"

/*$requete1 = $bdd->prepare('SELECT * FROM `users`');
$requete1->execute();
$resultat1 = $requete1->fetch();
$_SESSION['user_id'] = $resultat1['ID'];*/

    
      if(session_status() === PHP_SESSION_ACTIVE) //Si la session est active...
    {
      if(isset($_POST['Cookiebtn'])) //Si l'utilisateur a appuyé sur le bouton Accepter...
    { 
      //On cherche le mail selon l'id de l'utilisateur qui à appuyé sur le bouton
        $requete = $bdd->prepare('SELECT MAIL FROM `users` WHERE ID = :id');
        $requete->execute(array(
            'id' => $_SESSION['user_id']));  
        $resultat = $requete->fetch();
        $cookie_value=$resultat['MAIL'];
        setcookie('user',$cookie_value, time() + 5*365*24*3600, null, null, false, true); //cookie qui stocke l'adresse mailde l'utilisateur pour une durée de cinq ans
        header('Location: Accueil.php');
    }
    }
    else {
      
    }
 

?>