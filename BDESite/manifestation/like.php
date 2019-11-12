<?php
    $bdd = new PDO('mysql:host=localhost;dbname=projet_web;charset=utf8', 'root', '');

    //get l'utilisateur (id)($user)
    $user=2;//Gauthier Sannier
    $user_Nom=$_POST['name'];
    $user_Prenom=$_POST['firstname'];
    //get la manifestation (id)($manif)
    $manif=$_POST['id_manifestation'];//vente de crêpes
    $manif_Nom=$_POST['manif'];
    

    //on récupère la table des like qui relative à notre utilisateur
    $rqtSpe = $bdd->prepare('SELECT * FROM liker WHERE ID_USERS=:idU AND ID=:idM');
    $rqtSpe->bindValue(':idU',$user, PDO::PARAM_STR);
    $rqtSpe->bindValue(':idM',$manif, PDO::PARAM_STR);
    $rqtSpe->execute();
   
    $ligne = $rqtSpe->fetch();
    if($ligne){
      
        $rqtSpe = $bdd->prepare('DELETE FROM liker WHERE ID_USERS=:idU AND ID=:idM');
        
        $rqtSpe->bindValue(':idM',$manif, PDO::PARAM_STR);
        $rqtSpe->bindValue(':idU',$user, PDO::PARAM_STR);
        $rqtSpe->execute();
        //l'utilisateur à deja liké, on ne fait rien ou on suggère de dislike
        $message = "J'aime";
        echo $message;
        

    
    }
    else{
    //on envoie la requête dans la bdd
    $rqtInsertion = $bdd->exec("CALL liker_Manif('".$manif_Nom."', '".$user_Nom."', '".$user_Prenom."')");
    $message = "Aimé";
   echo $message;
    }  
    
    
    $rqtSpe->closeCursor();
?>