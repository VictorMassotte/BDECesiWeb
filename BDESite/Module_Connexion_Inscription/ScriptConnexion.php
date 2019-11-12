<?php
session_start();

include $_SERVER['DOCUMENT_ROOT']."/BDECESIWEB/BDESite/boutique/bdd.php";
//include_once $_SERVER['DOCUMENT_ROOT']."/BDECESIWEB/BDESite/Acceuil.php";


$email = $_POST['email'];
$hashpass = password_hash($_POST['password'], PASSWORD_DEFAULT);

    if(isset($_POST['submit']))
    {
        $response = $bdd->prepare('SELECT MAIL, PASSWORD  FROM users WHERE MAIL=:email');
        $response->bindParam(':email', $email, PDO::PARAM_STR);
        $response->execute();
        $result = $response->fetch();
        
    if($email == $result['MAIL'] && password_verify($hashpass, $result['PASSWORD']))
    {      
        header('location: ../acceuil.php');
        exit();   
    }
    elseif($email !== $result['MAIL'] && $hashpass !== password_verify($hashpass, $result['PASSWORD']))
    {
        echo ;
        echo "Vos identifiants sont incorrect";
    }
}
?>