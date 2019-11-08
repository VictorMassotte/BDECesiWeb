<?php include('verif.php'); ?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<h1>Ajout d'un produit</h1>
    <form method="post" action="ajoutArticle.php">
        <h4>Nom :</h4><input type="text" name="nom"/><br>
        <h4>Categorie :</h4><input type="text" name="categorie"/><br>
        <h4>Description :</h4><textarea name="description"></textarea><br>
        <h4>Prix :</h4><input type="text" name="prix"/><br>
        <h4>Stock :</h4><input type="text" name="stock"/><br><br>
        <input type="submit"/>
    </form>


<?php

include('../bdd.php'); 

if($_POST == NULL){

    echo"";

}else{

        $nom = $_POST['nom'];
        $categorie = $_POST['categorie'];
        $description = $_POST['description'];
        $prix = $_POST['prix'];
        $stock = $_POST['stock'];

        $response = $bdd->prepare("INSERT INTO `produits` (`NOM`, `DESCRIPTION`, `CATEGORIE`, `PRIX`, `STOCK`) VALUES (:nom, :description, :categorie, :prix, :stock)");
        $response->bindValue(':nom', $nom, PDO::PARAM_STR);
        $response->bindValue(':description', $description, PDO::PARAM_STR);
        $response->bindValue(':categorie', $categorie, PDO::PARAM_STR);
        $response->bindValue(':prix', $prix, PDO::PARAM_STR);
        $response->bindValue(':stock', $stock, PDO::PARAM_STR);
        $response->execute();

        echo "Vous avez bien enregistrer un nouveau produit";

        $response->closeCursor();

    }


?>
        