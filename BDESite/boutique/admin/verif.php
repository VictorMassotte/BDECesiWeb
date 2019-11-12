<?php

session_start();

if(isset($_SESSION['user_id'])){
    echo 'Connecte !';
    
}else{
    echo 'Pas connecte !';
    header('Location: ../Module_Connexion_Inscription/Connexion.php');
}
?>