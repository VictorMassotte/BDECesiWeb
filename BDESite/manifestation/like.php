<?php
    $bdd = new PDO('mysql:host=localhost;dbname=projet_web;charset=utf8', 'root', '');

    //get l'utilisateur (id)($user)
    $user=2;//Gauthier Sannier
    $user_Nom="Sannier";
    $user_Prenom="Gauthier";
    //get la manifestation (id)($manif)
    $manif=1;//vente de crêpes
    $manif_Nom="Vente de crêpes";

    //on récupère la table des like qui relative à notre utilisateur
    $rqtSpe = $bdd->prepare('SELECT * FROM liker WHERE ID_USERS=:idU');
    $rqtSpe->bindValue(':idU',$user, PDO::PARAM_STR);
    $rqtSpe->execute();
    echo "avant le while";
    $ligne = $rqtSpe->fetch();
    if($ligne){
    if($ligne['ID']==$manif){
        //l'utilisateur à deja liké, on ne fait rien ou on suggère de dislike
        echo"déja liké";
    }else{
        //on envoie la requête dans la bdd
        $rqtInsertion = $bdd->exec("CALL liker_Manif('".$manif_Nom."', '".$user_Nom."', '".$user_Prenom."')");
        echo "Requête exécutée avec succés";
    }
}
    
    $rqtSpe->closeCursor();
?>