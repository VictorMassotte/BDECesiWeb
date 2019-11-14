<?php
session_start();
    $bdd = new PDO('mysql:host=localhost;dbname=projet_web;charset=utf8', 'root', '');

    //get l'utilisateur (id)($user)
    if (isset($_POST['id_Com'])){
    
    
    $id_com = $_POST['id_Com'];
    $rqtSpe = $bdd->prepare('DELETE FROM `commenter` WHERE ID_COMMENTAIRE=:idc ');
    $rqtSpe->bindValue(':idc',$id_com, PDO::PARAM_STR);
    $rqtSpe->execute();

    
    
    
    
    $rqtSpe->closeCursor();
    
    
    
    }
    header('Location: manifpasse.php');
?>