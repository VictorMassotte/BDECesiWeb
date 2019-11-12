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
 
 <form class="form-signin" method="post" action="ScriptInscription.php">
 
   <h2 class="text-center">Inscription</h2>
   <label for="inputLastName" class="sr-only">Nom</label>
   <input type="text" id="inputNom" name="nom" class="form-control" placeholder="Votre Nom" required autofocus>

   <label for="inputFirstName" class="sr-only">Prénom</label>
   <input type="text" id="inputPrenom" name="prenom" class="form-control" placeholder="Votre Prenom" required>

   <label for="inputCampus" class="sr-only">Campus</label>
   <select name="campus" required>
    <option value="Paris Nanterre">Campus de Paris Nanterre</option>
    <option value="Reims">Campus de Reims</option>
    <option value="Arras">Campus d'Arras</option>
    <option value="Lille">Campus de Lille</option>
    <option value="Nancy">Campus de Nancy</option>
    <option value="Strasbourg">Campus de Strasbourg</option>
    <option value="Dijon">Campus de Dijon</option>
    <option value="Lyon">Campus de Lyon</option>
    <option value="Nice">Campus de Nice</option>
    <option value="Grenoble">Campus de Grenoble</option>
    <option value="Aix-en-Provence">Campus d'Aix-en-Provence</option>
    <option value="Toulouse">Campus de Toulouse</option>
    <option value="Pau">Campus de Pau</option>
    <option value="Bordeaux">Campus de Bordeaux</option>
    <option value="Angoulême">Campus d'Angoulême</option>
    <option value="La Rpchelle">Campus de La Rochelle</option>
    <option value="Châteauroux">Campus de Châteauroux</option>
    <option value="Le Mans">Campus du Mans</option>
    <option value="Nantes">Campus de Nantes</option>
    <option value="Saint-Nazaire">Campus de Saint-Nazaire</option>
    <option value="Brest">Campus de Brest</option>
    <option value="Saint-Nazaire">Campus de Saint-Nazaire</option>
    <option value="Rouen">Campus de Rouen</option>
    <option value="Caen">Campus de Caen</option>
  </select> 

   <label for="inputEmail" class="sr-only">Adresse mail</label>
   <input type="text" id="inputEmail" name="email" class="form-control" placeholder="Adresse mail" required>
   
   <label for="inputPassword" class="sr-only">Mot de Passe</label>
   <input type="password" id="inputPassword" name="password" class="form-control"  pattern=".{6,}" placeholder="Mot de passe" required>

   <label for="inputStatus" class="sr-only">Status</label>
   <select name="status" required>
    <option value="1">Elève</option>
    <option value="2">Membre du BDE</option>
    <option value="3">Intervenant</option>
    </select>

    <button name="submit" class="btn btn-success btn-block" type="submit">Inscription</button>
    <a href="Connexion.php" target="blank">Déjà enregistré ? </a>
 </form>

</div>
    </body>

</html>