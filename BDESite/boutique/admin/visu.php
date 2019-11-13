<?php 
session_start();
include('../bdd.php'); 
require_once('../../elements/menu.php'); 

if(isset($_SESSION['membre_BDE'])){
    
}elseif((isset($_SESSION['etudiant'])) || (isset($_SESSION['intervenant_CESI']))){
    header('Location: http://localhost/BDECesiWeb/BDESite/Module_Connexion_Inscription/Accueil.php');

}else{
    header('Location: ../Module_Connexion_Inscription/Connexion.php');
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/jumbotron/">
    <link href="jumbotron.css" rel="stylesheet">
    <link href="../style/boutique.css" rel="stylesheet">
    <title>Menu Admin Boutique</title>
</head>

<br><br><br>
<div class="jumbotron">
       <h1 class="display-4">Visuel des articles</h1>
    </div>

<?php 

$select = $bdd->prepare('SELECT * FROM produits');
$select->execute();

while($s=$select->fetch(PDO::FETCH_OBJ)){

    ?>

    <h5 class="text-center"><?php echo $s->NOM; ?>
    <a class="btn btn-warning" href="?action=modify&amp;id=<?php echo $s->ID; ?>">Modifier</a>
    <a class="btn btn-danger" href="?action=delete&amp;id=<?php echo $s->ID; ?>">Supprimer</a><br><br></h5>

<?php
}

if(isset ($_GET['action'])){  
    
    if($_GET['action'] == "delete"){
        
        $id = $_GET['id'];
        $delete = $bdd->prepare("DELETE FROM produits WHERE ID=:id");
        $delete->bindValue(':id', $id, PDO::PARAM_STR);
        $delete->execute();
        
        echo "Article bien supprime !";

        header('Location: visu.php');
    }
    
    if($_GET['action'] == 'modify'){

        $id = $_GET['id'];
        $select = $bdd->prepare("SELECT * FROM produits WHERE ID=:id");
        $select->bindValue(':id', $id, PDO::PARAM_STR);
        $select->execute();

        $data = $select->fetch(PDO::FETCH_OBJ);
        
    }?>

    <form method="post" action="">
        <h4>Nom :</h4><input value="<?php echo $data->NOM; ?>" type="text" name="nom"/><br>
        <h4>Categorie :</h4><input value="<?php echo $data->CATEGORIE; ?>" type="text" name="categorie"/><br>
        <h4>Description :</h4><textarea name="description"><?php echo $data->DESCRIPTION; ?></textarea><br>
        <h4>Prix :</h4><input value="<?php echo $data->PRIX; ?>" type="text" name="prix"/><br>
        <h4>Stock :</h4><input value="<?php echo $data->STOCK; ?>" type="text" name="stock"/><br><br>
        <input type="submit" name="submit" value="Modifier"/>
    </form>


<?php

if(isset($_POST['submit'])){
       
    $nom = $_POST['nom'];
    $categorie = $_POST['categorie'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];
    $stock = $_POST['stock'];
    
    $update = $bdd->prepare("UPDATE produits SET NOM=:nom,CATEGORIE=:categorie,DESCRIPTION=:description,PRIX=:prix,STOCK=:stock WHERE ID=:id");
    $update->bindValue(':nom', $nom, PDO::PARAM_STR);
    $update->bindValue(':categorie', $categorie, PDO::PARAM_STR);
    $update->bindValue(':description', $description, PDO::PARAM_STR);
    $update->bindValue(':prix', $prix, PDO::PARAM_STR);
    $update->bindValue(':stock', $stock, PDO::PARAM_STR);
    $update->bindValue(':id', $id, PDO::PARAM_STR);
    $update->execute();

}

}

?>

</html>
