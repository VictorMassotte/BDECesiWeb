<?php 
      if(isset($email) && !empty($email)){
        $cookie_value=$email;
        setcookie('user',$cookie_value, time() + 5*365*24*3600, null, null, false, true); //cookie pour une durée de cinq ans
        }
 ?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>      
       
        
        <title>Connexion</title>


       
    </head>
    <body>
    <div class="container">
 
 <form class="form-signin" method="post" action="ScriptConnexion.php">
 
   <h2 class="text-center">Connexion</h2>
   <label for="inputEmail" class="sr-only">Adresse mail</label>
   <input type="text" id="inputEmail" name="email" class="form-control" placeholder="Adresse mail" required autofocus>
   
   <label for="inputPassword" class="sr-only">Mot de Passe</label>
   <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Mot de passe" required>
    <button name="submit" class="btn btn-success btn-block" type="submit">Connexion</button>
    <a href="Inscription.php" target="blank">Je m'inscris </a>
 </form>

</div>
    </body>

</html>