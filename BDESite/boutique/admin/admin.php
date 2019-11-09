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

            <a href="AjoutArticle.php">Ajouter un article</a><br>
            <a href="visu.php">Modifier / Supprimer un article</a><br><br>

            <a href="addcategorie.php">Ajouter une categorie</a><br>
            <a href="edit_deletecategorie.php">Modifier / Supprimer une categorie</a><br>
      
        </div>
    </div>  
    
    </body>

</html>