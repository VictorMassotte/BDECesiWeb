<?php
session_start();
    $bdd = new PDO('mysql:host=localhost;dbname=projet_web;charset=utf8', 'root', '');

    //get l'utilisateur (id)($user)
    if (isset($_POST['id_User']) && isset($_POST['id_manifestation']) && isset($_POST['id_Com'])){
    $user=$_POST['id_User'];
    
    //get la manifestation (id)($manif)
    $manif=$_POST['id_manifestation'];//vente de crêpes
    
    $id_com = $_POST['id_Com'];
    $rqtSpe = $bdd->prepare('DELETE FROM `commenter` WHERE ID_COMMENTAIRE=:idc AND ID=:idm AND ID_USERS=:idu');
    $rqtSpe->bindValue(':idu',$user, PDO::PARAM_STR);
    $rqtSpe->bindValue(':idm',$manif, PDO::PARAM_STR);
    $rqtSpe->bindValue(':idc',$id_com, PDO::PARAM_STR);
    $rqtSpe->execute();

    
    
    
    
    $rqtSpe->closeCursor();
    
    
    
    }
    header('Location: manifpasse.php');
?>