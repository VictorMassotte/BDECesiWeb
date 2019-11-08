<?php

session_start();

$email="victor@cesi.fr";
$password_definit = '1234';

$mail = $_POST['mail'];
$password = $_POST['password'];


if(isset($_POST['submit'])){
    
    
    if($mail && $password){
        
        if($mail == $email && $password == $password_definit){
            
            $_SESSION['mail'] = $mail;
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



