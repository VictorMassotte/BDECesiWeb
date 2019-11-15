<?php 
session_start();
require_once('bdd.php'); 

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
       <h1 class="display-4">Ajout d'un produit dans la boutique</h1>
    </div>

<section class="text-center col-md-6 mb-3">
<form method="post" action="AjoutArticle.php" enctype="multipart/form-data">
    <div class="form-group">
        <label for="exampleInput">Nom : </label>
        <input type="text" class="form-control" name="nom" id="exampleFormControlInput1" placeholder="Le nom du produit">
    </div>
    <div class="form-group">
        <label for="exampleFormControlTextarea1">Description : </label>
        <textarea class="form-control" id="exampleFormControlTextarea1" name="description"  placeholder="La description du produit" rows="3"></textarea>
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
        <label for="exampleFormControlTextarea1">Prix :  </label>
            <input type="text" class="form-control" name="prix" id="exampleFormControlInput1" placeholder="Le prix du produit">
    </div>
    <div class="form-group">
        <label for="exampleFormControlTextarea1">Stock :  </label>
            <input type="text" class="form-control" name="stock" id="exampleFormControlInput1" placeholder="Le stock du produit">
    </div>
    <div class="form-group">
        <label for="exampleFormControlFile1">Image du produit : </label>
        <input type="file" name='img' class="form-control-file" id="exampleFormControlFile1">
    </div>   
    <button type="submit" name="submit" class="btn btn-primary mb-2">Ajouter l'article</button>
</form>
</section>


<?php

include('../bdd.php');

if(isset($_POST['submit'])){
    
    $nom = $_POST['nom'];
    $categorie = $_POST['categorie'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];
    $stock = $_POST['stock'];
    
    $img = $_FILES['img']['name'];
    $img_tmp = $_FILES['img']['tmp_name'];
    
    if(!empty($img_tmp)){
        
        $image = explode('.', $img);
        
        $image_ext = end($image);
        
        if(in_array(strtolower($image_ext), array('png', 'jpg', 'jpeg')) == false){
            echo 'Veuillez rentrer une image en .png ou .jpg ou .jpeg';
            
        }else{
            
            $image_size = getimagesize($img_tmp);
            
            if($image_size['mime'] == 'image/jpeg'){
                $image_src = imagecreatefromjpeg($img_tmp);
            }else if($image_size['mime'] == 'image/png'){
                $image_src = imagecreatefrompng($img_tmp);
            }else{
                
                $image_src = false;
                echo 'Veuillez rentrer une image valide !';
                
            }


            $response = $bdd->prepare("INSERT INTO `produits` (`NOM`, `DESCRIPTION`, `CATEGORIE`, `PRIX`, `STOCK`, NB_COMMANDE) VALUES (:nom, :description, :categorie, :prix, :stock, '0')");
            $response->bindValue(':nom', $nom, PDO::PARAM_STR);
            $response->bindValue(':description', $description, PDO::PARAM_STR);
            $response->bindValue(':categorie', $categorie, PDO::PARAM_STR);
            $response->bindValue(':prix', $prix, PDO::PARAM_STR);
            $response->bindValue(':stock', $stock, PDO::PARAM_STR);
            $response->execute();

            $nom = $_POST['nom'];
            $select_photos = $bdd->prepare("SELECT * FROM produits WHERE NOM=:nom");
            $select_photos->bindValue(':nom', $nom, PDO::PARAM_STR);
            $select_photos->execute();

            $s=$select_photos->fetch(PDO::FETCH_OBJ);
            $id_image = $s->ID;
            $image_finale = $image_src;
            imagejpeg($image_finale,'imgs/'.$id_image.'.jpg');


            echo "Vous avez bien enregistrer un nouveau produit";
            
            $response->closeCursor();
            
        }
        
    }else{
        echo 'Veuillez rentrer une image';
    }
  
    
}

?>

</html>
