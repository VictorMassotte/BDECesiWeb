<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<h1>Visuel des articles</h1>

<?php 
include('verif.php'); 
include('../bdd.php');

$select = $bdd->prepare('SELECT * FROM produits');
$select->execute();

while($s=$select->fetch(PDO::FETCH_OBJ)){

    echo $s->NOM;
    ?>

    <a href="?action=modify&amp;id=<?php echo $s->ID; ?>">Modifier</a>
    <a href="?action=delete&amp;id=<?php echo $s->ID; ?>">Supprimer</a><br><br>

<?php
}

if(isset ($_GET['action'])){  
    
    if($_GET['action'] == "delete"){
        
        $id = $_GET['id'];
        $delete = $bdd->prepare("DELETE FROM produits WHERE ID=$id");
        $delete->execute();
        
        echo "Article bien supprime !";
    }
    
    if($_GET['action'] == 'modify'){

        $id = $_GET['id'];
        $select = $bdd->prepare("SELECT * FROM produits WHERE ID=$id");
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
    
    $update = $bdd->prepare("UPDATE produits SET NOM='$nom',CATEGORIE='$categorie',DESCRIPTION='$description',PRIX='$prix',STOCK='$stock' WHERE ID=$id");
    $update->execute();

    header('Location: visu.php');
    
}

}

?>


