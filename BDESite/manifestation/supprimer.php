<?php
session_start();
if(isset($_SESSION['login'])){
    include('../boutique/bdd.php');
}else{
    header('Location: ../Module_Connexion_Inscription/Connexion.php');
}
   
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