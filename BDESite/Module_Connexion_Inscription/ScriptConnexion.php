<?php


require_once('../boutique/admin/bdd.php');

if(isset($_POST['submit'])){ //Si l'utilisateur appuie sur Connexion...

    $mail = $_POST['email'];
    //  Récupération de l'utilisateur et de son pass hashé
    $req = $bdd->prepare('SELECT * FROM users WHERE MAIL = :mail');
    
    $req->execute(array(
        'mail' => $mail));
        
        $resultat = $req->fetch();
        $id = $resultat['ID'];
        
        // Comparaison du pass envoyé via le formulaire avec la base
        $isPasswordCorrect = password_verify($_POST['password'], $resultat['PASSWORD']);
        
        if ($resultat == false) // Si l'id ne correspond pas avec l'adresse mail rentrée..
        {
            echo 'Mauvais identifiant ou mot de passe !';
        }
        else
        {
            if ($isPasswordCorrect) { //Si le hashage correspond...
                session_start();
                //On crée des variables de session qui retiendront les données de l'utilisateurs sur toutes les pages
                $_SESSION['login'] = true;
                $_SESSION['user_id'] = $id;
                $_SESSION['user_Nom'] = $resultat['NOM'];
                $_SESSION['user_Prenom'] = $resultat['PRENOM'];
                $_SESSION['user_Status'] = $resultat['STATUS'];
                $_SESSION['user_Mail'] = $resultat['MAIL'];

                    if( $_SESSION['user_Status'] == 1){ //Si l'utilisateur est un élève... 
                        $_SESSION['etudiant'] = true;
                        header ('location: Accueil.php');

                    }else if( $_SESSION['user_Status'] == 2){ //Si l'utilisateur est un membre du BDE... 
                        $_SESSION['membre_BDE'] = true;
                        header ('location: Accueil.php');


                    }else if( $_SESSION['user_Status'] == 3){ //Si l'utilisateur est un Intervenant... 
                        $_SESSION['intervenant_CESI'] = true;
                        header ('location: Accueil.php');

                    }else{ //Si aucun des status n'a correspond pour x raisons alors on arrête le script et on affiche un message d'erreur
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