<?php

session_start();
require_once('bdd.php');
include('../elements/menu.php');

if(isset($_SESSION['user_id'])){
    
}else{
    header('Location: http://localhost/BDECesiWeb/BDESite/Module_Connexion_Inscription/Connexion.php');
}


?>

<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Boutique BDE CESI</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/jumbotron/">
    <link href="jumbotron.css" rel="stylesheet">
    <link href="style/boutique.css" rel="stylesheet">
    <script src="js/recherche.js" type="text/javascript"></script>

  </head>

<body>

<br><br><br>
<div class="jumbotron">
       <h1 class="display-4">MENTIONS LEGALES</h1>
    </div>
<main role="main" class="container">

 <div lass="lead">
<h2>Éditeur : Association CESI</h2>
SIREN : 775 722 572<br>
Siège social :<br>
1, avenue du Général de Gaulle<br>
Tour PB5<br>
92074 Paris La Défense<br>
Tél : 01 44 45 92 00<br>
Fax : 01 44 45 92 98<br>
e-mail : contact@cesi.fr<br>

<br><br><h2>Respect de la vie privée et collecte des Données Personnelles</h2>
Soucieux de protéger la vie privée de ses clients, CESI s’engage dans la protection des données personnelles. Une politique sur la protection des données personnelles rappelle nos principes et nos actions visant au respect de la réglementation applicable en matière de protection des données à caractère personnel.<br>

Pour lire l’intégralité de notre politique sur la Protection des données personnelles cliquez-ici

<br><br><h2>Sécurité</h2>
Le CESI s’engage à mettre en œuvre tous les moyens nécessaires au bon fonctionnement du site. Cependant, le CESI ne peut pas garantir la continuité absolue de l’accès aux services proposés par le site. Les adhérents sont informés que les informations et services proposés sur le site pourront être interrompus en cas de force majeure et pourront le cas échéant contenir des erreurs techniques.

<br><br><h2>Utilisation de cookies</h2>
Des cookies sont utilisés sur nos sites.<br>

Pour plus d’informations, vous pouvez vous référer à la Politique sur le Protection des Données Personnelles en cliquant-ici

<br><br><h2>Déclarations d’activité</h2>
CESI SAS – Société par actions simplifiée au capital de 1.1M€<br>
342 707 502<br>
1, avenue du Général de Gaulle – Tour PB5 – 92074 Paris La Défense<br>
Tél. : +33(0) 1 44 19 23 45 – Fax : +33(0) 1 42 50 25 06<br>
Déclaration d’activité enregistrée sous le numéro 11 75 39666 75 auprès du Préfet de la région Ile-de-France.<br>
Cet enregistrement ne vaut pas agrément de l’État.<br>

CESI – association loi de 1901<br>
775 722 572<br>
1, avenue du Général de Gaulle – Tour PB5 – 92074 Paris La Défense<br>
Tél. : +33(0) 1 44 19 23 45 – Fax : +33(0) 1 42 50 25 06<br>
Déclaration d’activité enregistrée sous le numéro 11 75 47883 75 auprès du Préfet de la région Ile-de-France.<br>
Cet enregistrement ne vaut pas agrément de l’État.<br>
 
 
  </div>
  
</main>
</body>
</html>

<?php


require_once('../elements/footer.php');

?>