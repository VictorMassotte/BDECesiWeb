<?php

session_start();

if(isset($_SESSION['user_id'])){
    
}else{
    header('Location: ../Module_Connexion_Inscription/Connexion.php');
}
?>