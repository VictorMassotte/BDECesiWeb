<?php
include $_SERVER['DOCUMENT_ROOT']."/BDECESIWEB/BDESite/boutique/admin/bdd.php";
//include_once $_SERVER['DOCUMENT_ROOT']."/BDECESIWEB/BDESite/Acceuil.php";

$email = $_POST['email'];
$hashpass = password_hash($_POST['password'], PASSWORD_BCRYPT);
$password= '$2y$10$rtu/dTEu8F96JbcZ6eOKuOBad0UNTHDw40FTZW44YevCxSawZzX9K';


if(session_status() === PHP_SESSION_ACTIVE) //Si la session est ouverte...
{
    if(isset($_POST['submit'])) // Lorsqu'on appuie sur le bouton connexion...
    {
        $response = $bdd->prepare('SELECT MAIL, PASSWORD  FROM users WHERE MAIL=:email AND PASSWORD=:motdepasse'); //Trouve le mot de passe et l'email correspondant à ceux qu'on à rentré 
        $response->bindParam(':email', $email, PDO::PARAM_STR);
        $response->bindParam(':motdepasse', $hashpass, PDO::PARAM_STR);
        $response->execute();
        $result = $response->fetch(); 
        $pass_verif=password_verify($hashpass, $result['PASSWORD']); 
        
        if($email == $result['MAIL'] && password_verify($_POST['password'], $password))
        {  
            $response1 = $bdd->prepare('SELECT STATUS FROM users WHERE MAIL=:email'); //Trouve le status correspondant à l'email entrée
            $response1 = bindParam(':email', $email, PDO::PARAM_STR);
            $response1->execute();
            $result1 = $response1->fetch();
            
            $response2 = $bdd->prepare('SELECT * FROM users WHERE MAIL=:email'); //Récupère les données d'un utilisateur en référence à son adresse email
            $response2->bindParam(':email', $_SESSION['email'], PDO::PARAM_STR);
            $response2->execute();
            $result2 = $response2->fetch();

            $_SESSION['nom'] = $result2['NOM'];             //données tirées de la bdd de l'utilisateurs qui à rentrés ses identifiants
            $_SESSION['prenom'] = $result2['PRENOM'];
            $_SESSION['localisation'] = $result2['LOCALISATION'];
            $_SESSION['status'] = $result2['STATUS'];

        
            if($result1['STATUS'] == 2)  //Si le status trouvé dans la bdd correspondant à l'utilisateur qui à rentré son adresse mail est 2 on ouvre une session admin
            {
                $_SESSION['admin'] = $email;
                echo "Bienvenue sur notre site" .$_SESSION['email'];
                require ('../../admin.php');
            }   
            elseif($result1['STATUS'] == 1)   // Même chose mais on ouvre une session Elève
            {
                $_SESSION['Elève'] = $email;
                echo "Bienvenue sur notre site" .$_SESSION['email'];
                require ('../../index.php');
            }
            elseif($result1['STATUS'] == 3) // Même chose mais on ouvre une session Intervenant
            {
                $_SESSION['Intervenant'] = $email;
                echo "Bienvenue sur notre site" .$_SESSION['email'];
                require ('../../index.php');
            }    
           
        }
        else //Si le mot de passe ou l'adresse mail rentrée sont invalides
        {
            echo"mauvais mot de passe";
            require_once 'Connexion.php';
            print_r($result);          
        }      
    }
}   
?>