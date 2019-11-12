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
        $liked=true;                    
    }else{
        $liked=false;
    }
}
    
    $rqtSpe->closeCursor();
?>