<?php
session_start();
require_once('bdd.php');


if(isset($_SESSION['membre_BDE'])){
    
}elseif((isset($_SESSION['etudiant'])) || (isset($_SESSION['intervenant_CESI']))){
    header('Location: http://localhost/BDECesiWeb/BDESite/Module_Connexion_Inscription/Accueil.php');

}else{
    header('Location: http://localhost/BDECesiWeb/BDESite/Module_Connexion_Inscription/Connexion.php');
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/jumbotron/">
    <script src="../js/jquery-3.4.1.min.js"></script>
    <link href="../style/boutique.css" rel="stylesheet">
    <title>Menu Admin Boutique</title>
</head>
<?php include('../../elements/menu.php'); ?>
<div class="jumbotron">
       <h1 class="display-4">Ajouter une categorie à la boutique</h1>
</div>

    <form method="post" action="">

    <div class="form-group text-center">
        <label for="exampleInput">Nom de la categorie : </label>
        <input type="text" class="form-control" name="nom" id="exampleFormControlInput1" placeholder="Le nom du produit"><br>
        <button type="submit" name="submit" class="btn btn-primary mb-2">Ajouter une categorie</button>
    </div>

    </form>


<?php

if(isset($_POST['submit'])){
    
    $nom = $_POST['nom'];

    if($nom){

        $insert = $bdd->prepare("INSERT INTO `categorie` (`nom`) VALUES (:nom)");
        $insert->bindValue(':nom', $nom, PDO::PARAM_STR);
        $insert->execute();

                    
        echo "Vous avez bien enregistrer une nouvelle categorie";
        $insert->closeCursor();

    }else{
        echo 'Veuillez remplir le champs !';
    }       
        
    }
    
 require_once('../../elements/footer.php');
?>
