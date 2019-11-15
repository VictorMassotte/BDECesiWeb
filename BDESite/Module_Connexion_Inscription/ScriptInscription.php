<?php

require_once('../boutique/admin/bdd.php');

//Stockage des valeurs entrées dans les champs par l'utilisateur lors de son inscription 
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$localisation = $_POST['campus'];
$email = $_POST['email'];
$hashpass = password_hash($_POST['password'], PASSWORD_DEFAULT);
$status = $_POST['status'];
$err_msg="Adresse mail non valide";


if(isset($_POST['submit'])) //Si l'utilisateur appuie sur Inscription...
{
           
        /*if(!preg_match('#^[a-z.]+@cesi\.fr$#', $email)) //vérifie si elle se termine bien par "@cesi.fr"
        {  
            if(!preg_match('#^[a-z.]+@viacesi\.fr$#', $email)) //vérifie si elle se termine bien par "@viacesi.fr"
            { 
            echo $err_msg;                                          
            }                                                  
        }
        elseif(preg_match('#@cesi.fr#', $email))
        {
            $requete3 = $bdd->prepare("UPDATE `users` SET `STATUS` = 2 WHERE MAIL=:email");
            $requete3->bindParam(':email', $email, PDO::PARAM_STR);
            $requete3->execute();
        }
       
        elseif(preg_match('#@viacesi.fr#', $email))
        {
            $requete4 = $bdd->prepare("UPDATE `users` SET `STATUS` = 2 WHERE MAIL=:email");
            $requete4->bindParam(':email', $email, PDO::PARAM_STR);
            $requete4->execute();
        }*/

        if(!preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{6,}$#', $hashpass)) //exige la presence de minuscule et de majuscules ainsi que de chiffre avec une taille minimum de 6 caractères
        {
            echo "Mot de passe invalide";  
        }
            //On vérifie si le mail entrée lors de l'inscription existe déjà à l'aide cette requête préparée
            $requete = $bdd->prepare('SELECT MAIL FROM `users` WHERE MAIL=:email');
            $requete->bindParam(':email', $email, PDO::PARAM_STR);
            $requete->execute();
            $login=$requete->fetch();

        if($login) //S'il existe déjà on quitte la page et on affiche un message d'erreur
        {
            exit($err_msg);
        }    
            else 
            {
            try
            {
            //Renvoi d'eventuelles erreurs de traitement de la bdd 
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //Insertion des données saisies par l'utilisateur dans la bdd
            $requete2 = $bdd->prepare("INSERT INTO `users` (`NOM`, `PRENOM`, `LOCALISATION`, `MAIL`, `PASSWORD`, `STATUS`) VALUES(:nom, :prenom, :localisation, :email, :motdepasse, :status)");
            $requete2->bindParam(':nom', $nom, PDO::PARAM_STR);
            $requete2->bindParam(':prenom', $prenom, PDO::PARAM_STR);
            $requete2->bindParam(':localisation', $localisation, PDO::PARAM_STR);
            $requete2->bindParam(':email', $email, PDO::PARAM_STR);
            $requete2->bindParam(':motdepasse', $hashpass, PDO::PARAM_STR);
            $requete2->bindParam(':status', $status, PDO::PARAM_INT);
            $requete2->execute();
            //print_r($login);
            }
            catch (PDOException $ex) {
                echo  $ex->getMessage();
                print_r($bdd->errorInfo());
            }
            require_once 'Connexion.php';   
        }
            /*$msg = $requete2->execute();
            var_dump($msg);*/
        

    }

?>