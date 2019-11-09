<?php session_start() ?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>      
       
        
        <title>Inscription</title>


       
    </head>
    <body>
    <div class="container">
 
 <form class="form-signin" method="post" action="ScripInscription.php">
 
   <h2 class="text-center">Inscription</h2>
   <label for="inputLastName" class="sr-only">Nom</label>
   <input type="text" id="inputNom" name="nom" class="form-control" placeholder="Votre Nom" required autofocus>

   <label for="inputFirstName" class="sr-only">Prénom</label>
   <input type="text" id="inputPrenom" name="prenom" class="form-control" placeholder="Votre Prenom" required>

   <label for="inputCampus" class="sr-only">Campus</label>
   <input type="text" id="inputCampus" name="campus" class="form-control" placeholder="Votre Campus" required>

   <label for="inputEmail" class="sr-only">Adresse mail</label>
   <input type="text" id="inputEmail" name="email" class="form-control" placeholder="Adresse mail" required>
   
   <label for="inputPassword" class="sr-only">Mot de Passe</label>
   <input type="password" id="inputPassword" name="password" class="form-control"  pattern=".{6,}" placeholder="Mot de passe" required>
    <button name="submit" class="btn btn-success btn-block" type="submit">Inscription</button>
    <a href="Connexion.php" target="blank">Déjà enregistré ? </a>
 </form>

</div>
    </body>

</html>