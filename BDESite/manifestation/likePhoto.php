<?php
session_start();
if(isset($_SESSION['login'])){
    include('../boutique/bdd.php');
}else{
    header('Location: ../Module_Connexion_Inscription/Connexion.php');
}
   
    //get l'utilisateur (id)($user)
    /*$user=$_SESSION['user_id'];
    $user_Nom=$_SESSION['user_Nom'];
    $user_Prenom=$_SESSION['user_Prenom'];*/
    $user=$_SESSION['user_id'];//Gauthier Sannier
    
    $user_mail = $_SESSION['user_Mail'];
    //get la manifestation (id)($manif)
    $photo=$_POST['id_Photo'];//vente de crêpes
   
    

    //on récupère la table des like qui relative à notre utilisateur
    $rqtSpe = $bdd->prepare('SELECT * FROM likerphoto WHERE ID_USERS=:idU AND ID=:idM');
    $rqtSpe->bindValue(':idU',$user, PDO::PARAM_STR);
    $rqtSpe->bindValue(':idM',$photo, PDO::PARAM_STR);
    $rqtSpe->execute();
   
    $ligne = $rqtSpe->fetch();
    if($ligne){
      
        $rqtSpe = $bdd->prepare('DELETE FROM likerphoto WHERE ID_USERS=:idU AND ID=:idM');
        
        $rqtSpe->bindValue(':idM',$photo, PDO::PARAM_STR);
        $rqtSpe->bindValue(':idU',$user, PDO::PARAM_STR);
        $rqtSpe->execute();
        //l'utilisateur à deja liké, on ne fait rien ou on suggère de dislike
        $message = "J'aime";
        echo $message;
        

    
    }
    else{
    //on envoie la requête dans la bdd
    $rqtInsertion = $bdd->query("INSERT INTO `likerphoto`(`ID`, `ID_USERS`) VALUES (".$photo.",".$user.")");
    
    $message = "Aimé";
   echo $message;
    }  
    
    
    $rqtSpe->closeCursor();
?>