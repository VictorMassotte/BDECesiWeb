<?php
session_start();

include $_SERVER['DOCUMENT_ROOT']."/BDECESIWEB/BDESite/boutique/bdd.php";

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$localisation = $_POST['campus'];
$email = $_POST['email'];
$hashpass = password_hash($_POST['password'], PASSWORD_DEFAULT);
$err_msg="Adresse mail non valide";

if(isset($_POST['submit']))
{
           
        if(!preg_match('#^[a-z.]+@cesi\.fr$#', $email)) //vérifie si elle se termine bien par "@cesi.fr"
        {  
            if(!preg_match('#^[a-z.]+@viacesi\.fr$#', $email)) //vérifie si elle se termine bien par "@viacesi.fr"
            { 
            echo $err_msg;                                          
            }                                                  
        }
        elseif(preg_match('#@cesi.fr#', $email))
        {
            $requete3 = $bdd->prepare("INSERT INTO `users` (`STATUS`) VALUES('Eleve')'");
            $requete3->execute();
        }
       
        elseif(preg_match('#@viacesi.fr#', $email))
        {
            $requete4 = $bdd->prepare("INSERT INTO `users` (`STATUS`) VALUES('intervenant')'");
            $requete4->execute();
        }

        if(!preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{6,}$#', $hashpass)) //exige la presence de minuscule et de majuscules ainsi que de chiffre avec une taille minimum de 6 caractères
        {
            echo "Mot de passe invalide";  
        }
        $requete = $bdd->prepare('SELECT MAIL FROM `users` WHERE MAIL=:email');
        $requete->bindParam(':email', $email, PDO::PARAM_STR);
        $requete->execute();
        $login=$requete->fetch();

        if($login)
        {
            exit($err_msg);
        }    
            else 
            {
            try
            {
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $requete2 = $bdd->prepare("INSERT INTO `users` (`NOM`, `PRENOM`, `LOCALISATION`, `MAIL`, `PASSWORD`) VALUES(:nom, :prenom, :localisation, :email, :motdepasse)");
            $requete2->bindParam(':nom', $nom, PDO::PARAM_STR);
            $requete2->bindParam(':prenom', $prenom, PDO::PARAM_STR);
            $requete2->bindParam(':localisation', $localisation, PDO::PARAM_STR);
            $requete2->bindParam(':email', $email, PDO::PARAM_STR);
            $requete2->bindParam(':motdepasse', $hashpass, PDO::PARAM_STR);
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