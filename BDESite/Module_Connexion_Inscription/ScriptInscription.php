<?php
session_start();

include $_SERVER['DOCUMENT_ROOT']."/BDECESIWEB/BDESite/boutique/bdd.php";

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$localisation = $_POST['campus'];
$email = $_POST['email'];
$motdepasse = $_POST['password'];
$err_msg="Adresse mail non valide";

if(isset($_POST['submit'])){
    $requete = $bdd->prepare('SELECT MAIL, PASSWORD  FROM `users` WHERE email=:email and motdepasse="'.$_POST['password'].'"');
    $requete->bindParam(':email', $email, PDO::PARAM_STR);
    $requete->execute();
    $login=$requete->fetch();

        if($email == strtolower($login['email']))
        {
            echo $err_msg;
        }
        if(!preg_match('#^[a-z.]+@viacesi\.fr|cesi\.fr$#', $email)){ //vérifie si elle contient des lettres de l'alphabet
            echo $err_msg;                                          //la présence d'arobase et d'un point
        }
        if(!preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{6,}$#', $motdepasse)) //exige la presence de minuscule et de majuscules ainsi que de chiffre avec une taille minimum de 6 caractères
        {
            echo "Mot de passe invalide";  
        }
        if(preg_match('#@viacesi.fr#', $email))
        {
            $requete3 = $bdd->prepare("INSERT INTO `users` (`STATUS`) VALUES('Eleve')'");
            $requete3->execute();
        }
        if(preg_match('#@cesi.fr#', $email))
        {
            $requete4 = $bdd->prepare("INSERT INTO `users` (`STATUS`) VALUES('Intervenant')");
            $requete4->execute();
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
            $requete2->bindParam(':motdepasse', $motdepasse, PDO::PARAM_STR);
            $requete2->execute();
            }
            catch (PDOException $ex) {
                echo  $ex->getMessage();
                print_r($bdd->errorInfo());
            }
            require_once 'Connexion.php';
            
	
            /*$msg = $requete2->execute();
            var_dump($msg);*/
        }

    }

?>