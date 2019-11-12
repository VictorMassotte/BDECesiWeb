<?php

session_start();
require_once('../boutique/bdd.php');

if(isset($_POST['submit'])){

    $mail = $_POST['email'];
    //  Récupération de l'utilisateur et de son pass hashé
    $req = $bdd->prepare('SELECT * FROM users WHERE MAIL = :mail');
    
    $req->execute(array(
        'mail' => $mail));
        
        $resultat = $req->fetch();
        $id = $resultat['ID'];
        
        // Comparaison du pass envoyé via le formulaire avec la base
        $isPasswordCorrect = password_verify($_POST['password'], $resultat['PASSWORD']);
        
        if ($resultat == false)
        {
            echo 'Mauvais identifiant ou mot de passe !';
        }
        else
        {
            if ($isPasswordCorrect) {

                    if($resultat['STATUS'] == 1){
                        $_SESSION['user_id'] = $id;
                        $_SESSION['membre_BDE'] = $mail;

                        require_once('Accueil.php');

                    }else if($resultat['STATUS'] == 2){
                        $_SESSION['user_id'] = $mail;
                        $_SESSION['membre_BDE'] = $mail;
                        require_once('Accueil.php');


                    }else if($resultat['STATUS'] == 3){
                        $_SESSION['user_id'] = $mail;
                        $_SESSION['intervenant_CESI'] = $mail;
                        require_once('Accueil.php');

                    }else{
                        die();
                    }
            }
            else {
                echo 'Mauvais identifiant ou mot de passe !';
                require_once 'Connexion.php';  
            }
        }
    }
?>