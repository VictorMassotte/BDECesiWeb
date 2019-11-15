<?php 
session_start();
include('../bdd.php'); 

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
<?php include('../../elements/menu.php'); ?>

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
    <a class="btn btn-danger" href="?action=delete&amp;id=<?php echo $s->ID; ?>">Supprimer</a><br><br>

<?php

    }

if(isset ($_GET['action'])){  
    
    if($_GET['action'] == "delete"){
        
        $id = $_GET['id'];
        $delete = $bdd->prepare("DELETE FROM produits WHERE ID=:id");
        $delete->bindValue(':id', $id, PDO::PARAM_STR);
        $delete->execute();
        //header('Location: visu.php');


    }
    
    if($_GET['action'] == 'modify'){

        $id = $_GET['id'];
        $select = $bdd->prepare("SELECT * FROM produits WHERE ID=:id");
        $select->bindValue(':id', $id, PDO::PARAM_STR);
        $select->execute();

        $data = $select->fetch(PDO::FETCH_OBJ);

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
            
            //header('Location: visu.php');

        }
     ?>

<section class="text-center col-md-6 mb-3 ">
    <form method="POST" action="">
    <div class="form-group">
        <label for="exampleInput">Nom : </label>
        <input value="<?php echo $data->NOM; ?>" type="text" class="form-control" name="nom" id="exampleFormControlInput1" placeholder="Le nom du produit">
    </div>
    <div class="form-group">
        <label for="exampleFormControlTextarea1">Description : </label>
        <textarea rows="3" id="exampleFormControlTextarea1" class="form-control" name="description"><?php echo $data->DESCRIPTION; ?></textarea><br>
    </div>
    <div class="form-group">
        <label for="exampleFormControlTextarea1">Prix :  </label>
            <input type="text" value="<?php echo $data->PRIX; ?>" class="form-control" name="prix" id="exampleFormControlInput1" placeholder="Le prix du produit">
    </div>
    <div class="form-group">
        <label for="exampleFormControlSelect1">Categorie : </label>
        <select class="form-control" name="categorie" id="exampleFormControlSelect1">
            <?php $select=$bdd->query("SELECT * FROM categorie");
            while($s = $select->fetch(PDO::FETCH_OBJ)){
                ?>
                <option><?php echo $s->nom; ?></option>
                
                <?php } ?>
            </select>
        </div>
    <div class="form-group">
        <label for="exampleFormControlTextarea1">Categorie du produit en ce moment : <?php echo $data->CATEGORIE; ?></label>
    </div>
    <div class="form-group">
        <label for="exampleFormControlTextarea1">Prix :  </label>
            <input type="text" value="<?php echo $data->PRIX; ?>" class="form-control" name="prix" id="exampleFormControlInput1" placeholder="Le prix du produit">
    </div>
    <div class="form-group">
        <label for="exampleFormControlTextarea1">Stock :  </label>
            <input type="text" value="<?php echo $data->STOCK; ?>" class="form-control" name="stock" id="exampleFormControlInput1" placeholder="Le stock du produit">
    </div>
    <button type="submit" name="submit" class="btn btn-primary mb-2">Modifier l'article</button>
    </form>
     </section>
     <div class="text-center">
        <a href="visu.php" class="btn btn-primary ">Actualiser la page</a>
    </div><br><br>


<?php


    }
}

require_once('../../elements/footer.php');

?>
