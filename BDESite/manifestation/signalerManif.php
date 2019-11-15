<?php
session_start();
if(isset($_SESSION['intervenant_CESI'])){
    include('../boutique/bdd.php');
}else{
    header('Location: ../Module_Connexion_Inscription/Connexion.php');
}
   
//get l'utilisateur (id)($user)
if (isset($_POST['ID'])){
   
    
    $id_manif = $_POST['ID'];
    $rqtSpe = $bdd->prepare('SELECT NOM FROM manifestations WHERE ID=:idm');
    
    $rqtSpe->bindValue(':idm',$id_manif, PDO::PARAM_STR);
    $rqtSpe->execute();
    $nom;
    if ($ligne=$rqtSpe->fetch())
    {
        
       $nom = $ligne['NOM'];
    }
   
    $rqtSpe->closeCursor();
    $body = $nom;
    
    $headers = 'From: projet.webcesi92@gmail.com' ."\r\n".
    'MIME-Version: 1.0' ."\r\n".
    'Content-type: text/html; charset=utf-8';
    
    $rqt = $bdd->prepare('SELECT MAIL from users WHERE STATUS=2');
    $rqt->execute();
    while($ligne1=$rqt->fetch()){
      
       mail($ligne1['MAIL'], "Signalement de manifestation",$body, $headers);
       
        
    }
    $rqt->closeCursor(); 
    
    
}


//header('Location: manifpasse.php');
?>