<?php
session_start();
if(isset($_SESSION['login'])){
    include('../boutique/bdd.php');
}else{
    header('Location: ../Module_Connexion_Inscription/Connexion.php');
}
    
    //get l'utilisateur (id)($user)
    $user=$_SESSION['user_id'];
    
    
    $user_mail = $_SESSION['user_Mail'];
    //get la manifestation (id)($manif)
    $manif=$_POST['id_manifestation'];
    $manif_Nom=$_POST['manif'];
    
    //on récupère la table des inscrits
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
        //l'utilisateur est déjà inscrit, on le désinscrit
        $message = "Je m'inscrit";
        echo $message;
        
    
    }
    else{
    //on envoie la requête dans la bdd
    //on inscrit l'utilisateur
    $rqtInsertion = $bdd->exec("CALL inscription('".$manif_Nom."', '".$user_mail."')");
    $message = "Inscrit";
    echo $message;
    }  
    
    
    $rqtSpe->closeCursor();
?>