<?php
session_start();
if(isset($_SESSION['intervenant_CESI'])){
    include('../boutique/bdd.php');
}else{
    header('Location: ../Module_Connexion_Inscription/Connexion.php');
}
   
//get l'utilisateur (id)($user)
if (isset($_POST['Photo'])){
   
    //on récupère le nom de la photo
    $photo = $_POST['Photo'];
    
    $body = $photo;
    //on envoie le mail à tous les membres du bde
    $headers = 'From: projet.webcesi92@gmail.com' ."\r\n".
    'MIME-Version: 1.0' ."\r\n".
    'Content-type: text/html; charset=utf-8';
    
    $rqt = $bdd->prepare('SELECT MAIL from users WHERE STATUS=2');
    $rqt->execute();
    while($ligne1=$rqt->fetch()){
      
       mail($ligne1['MAIL'], "SignalementPhoto",$body, $headers);
       
        
    }
    $rqt->closeCursor(); 
    
    
}
?>