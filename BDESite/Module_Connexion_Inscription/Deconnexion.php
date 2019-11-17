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
        background: url("https://media.discordapp.net/attachments/491542158164099072/644147980848463912/fond_cesi.png?width=948&height=586") no-repeat  center center;
        background-attachment: fixed;
        background-size: cover;
        background-attachment:fixed;
        background-position: center center;
        }
        #ImageCesiTrois {
            position: absolute;
            left: 10px;
            top: 5px;     
        }
        #Reco {
            position: absolute; /* postulat de départ */
            transform: translate(-50%, -50%);
            margin: auto;
            width: 500px;
            height:150px;
            display:flex;
            flex-direction: column;
            top:50%;
            left:50%;
        }
        #Texte {
            position:relative;
            left:77%;
            top:10%;
             /* à 50%/50% du parent référent */
            transform: translate(-50%, -50%);
            justify-self:center;
        }
        </style>

        <title>Déconnexion</title>
    </head>
<body>
        <div class="container" id="Reco">
        <h4 id="Texte"> Vous êtes déconnecté </h4>  
        <button type="submit" name="Deco"  class="btn btn-primary"><a href="Connexion.php" style="color:white;">Retour à la connexion</a></button>
        </div>
        <img  alt="" src="https://image.noelshack.com/fichiers/2019/46/5/1573816941-logo-cesi.png" width="400px" height="90px" id="ImageCesiTrois">
        
</body>     
 </html>   