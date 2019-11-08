<?php

session_start();

if(isset($_SESSION['mail'])){

}else{

    header('Location: ../index.php');
}
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="css/style.css" />

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        
        <title>Menu Admin Boutique</title>
    </head>

    <body>
  
    <div id="corps">

        <h1> Menu Admin Boutique</h1></div>

        <div id="barre_boutons_admin">

            <a href="AjoutArticle.php">Ajouter un article</a>
            <a href="visu.php">Modifier / Supprimer</a>
      
        </div>
    </div>  
    
    </body>

</html>