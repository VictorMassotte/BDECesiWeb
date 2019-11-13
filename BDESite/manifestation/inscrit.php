<?php
session_start();
    $bdd = new PDO('mysql:host=localhost;dbname=projet_web;charset=utf8', 'root', '');

    //get l'utilisateur (id)($user)
    /*$user=$_SESSION['user_id'];
    $user_Nom=$_SESSION['user_Nom'];
    $user_Prenom=$_SESSION['user_Prenom'];*/
    $user=2;//Gauthier Sannier
    $user_mail = $_POST['mail'];
    //get la manifestation (id)($manif)
    $manif=$_POST['id_manifestation'];//vente de crêpes
    $manif_Nom=$_POST['manif'];
    

    //on récupère la table des like qui relative à notre utilisateur
    $rqtSpe = $bdd->prepare('SELECT * FROM inscrire WHERE ID_USERS=:idU AND ID=:idM');
    $rqtSpe->bindValue(':idU',$user, PDO::PARAM_STR);
    $rqtSpe->bindValue(':idM',$manif, PDO::PARAM_STR);
    $rqtSpe->execute();
   
    $ligne = $rqtSpe->fetch();
    if($ligne){
      
        $rqtSpe = $bdd->prepare('DELETE FROM inscrire WHERE ID_USERS=:idU AND ID=:idM');
        
        $rqtSpe->bindValue(':idM',$manif, PDO::PARAM_STR);
        $rqtSpe->bindValue(':idU',$user, PDO::PARAM_STR);
        $rqtSpe->execute();
        //l'utilisateur à deja liké, on ne fait rien ou on suggère de dislike
        $message = "Je m'inscrit";
        echo $message;
        

    
    }
    else{
    //on envoie la requête dans la bdd
    $rqtInsertion = $bdd->exec("CALL inscription('".$manif_Nom."', '".$user_mail."')");
    $message = "Inscrit";
    echo $message;
    }  
    
    
    $rqtSpe->closeCursor();
?>