<?php


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
                session_start();
                $_SESSION['login'] = true;
                $_SESSION['user_id'] = $id;
                $_SESSION['user_Nom'] = $resultat['NOM'];
                $_SESSION['user_Prenom'] = $resultat['PRENOM'];
                $_SESSION['user_Status'] = $resultat['STATUS'];
                $_SESSION['user_Mail'] = $resultat['MAIL'];

                    if( $_SESSION['user_Status'] == 1){
                        $_SESSION['etudiant'] = true;

                        header ('location: Accueil.php');

                    }else if( $_SESSION['user_Status'] == 2){
                        $_SESSION['membre_BDE'] = true;
                        header ('location: Accueil.php');


                    }else if( $_SESSION['user_Status'] == 3){
                        $_SESSION['intervenant_CESI'] = true;
                        header ('location: Accueil.php');

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