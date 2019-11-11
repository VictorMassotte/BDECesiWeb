<?php
session_start();

include $_SERVER['DOCUMENT_ROOT']."/BDECESIWEB/BDESite/boutique/bdd.php";

$email = $_POST['email'];
$motdepasse = $_POST['password'];

if(isset($_POST['submit'])){
    $response = $bdd->query('SELECT MAIL, PASSWORD  FROM users WHERE email="'.$_POST['email'].'" and motdepasse="'.$_POST['password'].'"');
    $result = $response->fetch();
    
    if(strtolower($email) == strtolower($result['email']) && password_verify($motdepasse, $data[0]['PASSWORD'])){
        require_once 'acceuil.php';
    }
    else{
        echo "Vos identifiants sont incorrect";
    }
}
?>