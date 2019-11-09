<?php
session_start();

define('BDD_PATH', '/boutique');
include BDD_PATH . '/bdd.php'; 

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$localisation = $_POST['campus'];
$email = $_POST['email'];
$motdepasse = $_POST['password'];

if(isset($_POST['submit'])){
    $requete = $bdd->prepare('SELECT MAIL, PASSWORD  FROM users WHERE email="'.$_POST['email'].'" and motdepasse="'.$_POST['password'].'"');
    $requete->bindValue(':email',$pseudo, PDO::PARAM_STR);
    $requete->execute();
    $login=$requete->fetch();

        if($email == strtolower($login['email']))
        {
            $err_msg="Adresse mail non valide";
            echo $err_msg;
        }
        if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)){ //vérifie si elle contient bien des lettres de l'alphabet
            echo $err_msg;                                                                           //des tirets du huit, des espaces, des chiffres, et la présence d'arobase et d'un point
        }
        if(!preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{6,}$#', $motdepasse)) //exige la presence de minuscule et de majuscules ainsi que de chiffre avec une taille minimum de 6 caractères
        {
            echo "Mot de passe invalide";  
        }
        else
        {
            $requete2 = $bdd->prepare("INSERT INTO users (NOM, PRENOM, LOCALISTAION, MAIL, PASSWORD) VALUES( :nom,:prenom,:localisation,:email,:motdepasse)");
            $requete2->bindValue(':nom', $nom, PDO::PARAM_STR);
            $requete2->bindValue(':prenom', $prenom, PDO::PARAM_STR);
            $requete2->bindValue(':localisation', $localisation, PDO::PARAM_STR);
            $requete2->bindValue(':email', $email, PDO::PARAM_STR);
            $requete2->bindValue(':motdepasse', $motdepasse, PDO::PARAM_STR);
            $requete2->execute();
            require_once 'Connexion.php';
        }
    }

?>