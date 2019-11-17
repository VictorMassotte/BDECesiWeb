<?php
$newid = session_create_id('myprefix-');
if(!session_id($newid))
{
    $NewName = ini_set('session.name','newname');
    session_name($NewName);
    session_start();    // On démarre la session AVANT toute chose
}
 ?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>    
       
        <style type="text/css">
        body {
        background: url("https://media.discordapp.net/attachments/491542158164099072/644147980848463912/fond_cesi.png?width=948&height=586") no-repeat  center center;
        background-attachment: fixed;
    background-size: cover;
        }
        #DeuxForm {
            position: absolute; /* postulat de départ */
            top: 50%; left: 50%; /* à 50%/50% du parent référent */
            transform: translate(-50%, -50%);
        }
        #ImageCesi {
            position: absolute;
    left: 10px;
    top: 5px; 
        }
        </style>

        <title>Connexion</title>
       
    </head>
   <body>
    <div class="container" id="DeuxForm">
     <form class="form-signin" method="post" action="ScriptConnexion.php">
      <h2 class="text-center">Connexion</h2>
       </br>
        <label for="inputEmail" class="sr-only">Adresse mail</label>
         <input type="text" id="inputEmail" name="email" class="form-control" placeholder="Adresse mail" required autofocus>
          <label for="inputPassword" class="sr-only">Mot de Passe</label>
           <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Mot de passe" required>
            </br>
             <button name="submit" class="btn btn-primary btn-block" type="submit">Connexion</button>
              <a href="Inscription.php">Je m'inscris </a>
             </form>
            </div>
           <img  src="https://image.noelshack.com/fichiers/2019/46/5/1573816941-logo-cesi.png" width="400px" height="110px" id="ImageCesi">
          </div>
         </body>

</html>