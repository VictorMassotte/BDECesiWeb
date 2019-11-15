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
       
        <style type="text/css">
        body {
        background: url("https://media.discordapp.net/attachments/491542158164099072/644147980848463912/fond_cesi.png?width=948&height=586");
        background-repeat: no-repeat;
        background-size: cover;
        }
        #PremForm {
        padding: 0px 100px 0px 100px; 
        margin:130px 0px 0px 250px;
        }
        #ImageCesiDeux {
        margin:-1028px 0px 0px 0px;     
        }
        </style>

        <title>Inscription</title>

    </head>
    <body>
     <div class="container" id="PremForm">
      <form class="form-signin" method="post" action="ScriptInscription.php">
 
   <h2 class="text-center">Inscription</h2>
   <label for="inputLastName" class="sr-only">Nom</label>
   <input type="text" id="inputNom" name="nom" class="form-control" placeholder="Votre Nom" required autofocus>
   </br>
   <label for="inputFirstName" class="sr-only">Prénom</label>
   <input type="text" id="inputPrenom" name="prenom" class="form-control" placeholder="Votre Prenom" required>
   </br>
   <div class="form-group">
        <label for="exampleFormControlSelect1" class="sr-only">Campus </label>
        <select class="form-control" name="campus">
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
    </div>    
   <label for="inputEmail" class="sr-only">Adresse mail</label>
   <input type="text" id="inputEmail" name="email" class="form-control" placeholder="Adresse mail" required>
   </br>
   <div class="form-group">
   <label for="exampleFormControlSelect1" class="sr-only">Status </label>
    <select class="form-control" name="status">
    <option value="1">Elève</option>
    <option value="2">Membre du BDE</option>
    <option value="3">Intervenant</option>
    </select>
   </div>
   <label for="inputPassword" class="sr-only">Mot de Passe</label>
   <input type="password" id="inputPassword" name="password" class="form-control"  pattern=".{6,}" placeholder="Mot de passe" required>    
   
   </br>        
    <button class="btn btn-primary btn-block" type="button" data-toggle="modal" data-target="#exampleModal">Inscription</button>
    <a href="Connexion.php" target="blank">Déjà enregistré ? </a>

    <div class="modal bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Mentions légales</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>
        <div class="modal-body">
                <p>Éditeur : Association CESI<br>
                SIREN : 775 722 572<br>
                Siège social :<br>
                1, avenue du Général de Gaulle
                Tour PB5
                92074 Paris La Défense<br>
                Tél : 01 44 45 92 00
                Fax : 01 44 45 92 98<br>
                e-mail : contact@cesi.fr

                Développement & hébergement<br>
                
                Respect de la vie privée et collecte des Données Personnelles<br>
                Soucieux de protéger la vie privée de ses clients, CESI s’engage dans la protection des données personnelles. Une politique sur la protection des données personnelles rappelle nos principes et nos actions visant au respect de la réglementation applicable en matière de protection des données à caractère personnel.<br>

                Sécurité<br>
                Le CESI s’engage à mettre en œuvre tous les moyens nécessaires au bon fonctionnement du site. Cependant, le CESI ne peut pas garantir la continuité absolue de l’accès aux services proposés par le site. Les adhérents sont informés que les informations et services proposés sur le site pourront être interrompus en cas de force majeure et pourront le cas échéant contenir des erreurs techniques.<br>

                Utilisation de cookies<br>
                Des cookies sont utilisés sur nos sites.<br>

                Déclarations d’activité<br>
                CESI SAS – Société par actions simplifiée au capital de 1.1M€<br>  
                1, avenue du Général de Gaulle – Tour PB5 – 92074 Paris La Défense<br>
                Tél. : +33(0) 1 44 19 23 45 – Fax : +33(0) 1 42 50 25 06<br>
                Déclaration d’activité enregistrée sous le numéro 11 75 39666 75 auprès du Préfet de la région Ile-de-France.<br>
                Cet enregistrement ne vaut pas agrément de l’État.<br>

                CESI – association loi de 1901
                775 722 572
                1, avenue du Général de Gaulle – Tour PB5 – 92074 Paris La Défense
                Tél. : +33(0) 1 44 19 23 45 – Fax : +33(0) 1 42 50 25 06
                Déclaration d’activité enregistrée sous le numéro 11 75 47883 75 auprès du Préfet de la région Ile-de-France.
                Cet enregistrement ne vaut pas agrément de l’État.</p>
        </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" >Annuler</button>
                <button type="submit" name="submit" class="btn btn-primary" >Accepter</button>
            </div>
        </div>
    </div>
</div>
</form>
</div>
<img  src="https://image.noelshack.com/fichiers/2019/46/5/1573816941-logo-cesi.png" width="400px" height="90px" id="ImageCesiDeux">
</body>
</html>