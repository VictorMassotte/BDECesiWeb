<?php
session_start();

define('BDD_PATH', '/boutique');
include BDD_PATH . '/bdd.php'; 

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