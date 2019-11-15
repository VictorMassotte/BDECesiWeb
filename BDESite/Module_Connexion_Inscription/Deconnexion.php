<?php 
session_start();
session_destroy(); 
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
       
        <style type="text/css">
        body {
        background: url("https://media.discordapp.net/attachments/491542158164099072/644147980848463912/fond_cesi.png?width=948&height=586");
        background-repeat: no-repeat;
        background-size: cover;
        position:fixed;
        }
        #ImageCesiTrois {
        margin:-700px 0px 0px 0px;     
        }
        #Reco {
        margin:400px 0px 0px 700px;
        padding:0px;    
        }
        #Texte{
        margin: -100px 0px 0px 675px;   
        }
        </style>

        <title>Déconnexion</title>
    </head>
<body>
        <div class="container" id="Reco">
        <button type="submit" name="Deco"  class="btn btn-primary"><a href="Connexion.php" style="color:white;">Retour à la connexion</a></button>
        </div>
        <img  src="https://image.noelshack.com/fichiers/2019/46/5/1573816941-logo-cesi.png" width="400px" height="90px" id="ImageCesiTrois">
        <h4 id="Texte"> Vous êtes déconnecté </h4>  
</body>     
 </html>   