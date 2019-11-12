<?php

session_start();

$email="victor@cesi.fr";
$password_definit = '$2y$10$rtu/dTEu8F96JbcZ6eOKuOBad0UNTHDw40FTZW44YevCxSawZzX9K';

$mail = $_POST['mail'];
$password = $_POST['password'];


if(isset($_POST['submit'])){
    
    
    if($mail && $password){
        
        if($mail == $email && password_verify($password, $password_definit)){
            
            $_SESSION['membre_BDE'] = $mail;
            echo 'Connecter !';
            header('Location: admin.php');
            
        }else{
            echo 'Identifiants incorect !';
        }
    }else{
        echo 'Veuillez remplir tous les champs!';
    }
}


?>


<h1>Connexion à la page Administration </h1>

    <form action="" method="POST">
        <h3>Email : </h3>
        <input type="text" name="mail"></br>
        <h3>PassWord :</h3>
        <input type="password" name="password"></br>
        <input type="submit" name="submit">
        
    </form>



