<?php 
session_start();
include('../bdd.php'); 

if(isset($_SESSION['membre_BDE'])){
    
}elseif((isset($_SESSION['etudiant'])) && (isset($_SESSION['intervenant']))){
    header('Location: ../index.php');

}else{
    header('Location: ../Module_Connexion_Inscription/Connexion.php');
}

?>

?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<h1>Ajout d'un produit</h1>
    <form method="post" action="AjoutArticle.php" enctype="multipart/form-data">
        <h4>Nom :</h4><input type="text" name="nom"/><br>
        <h4>Description :</h4><textarea name="description"></textarea><br><br>
        <h4>Categorie :</h4><select name="categorie">

        <?php $select=$bdd->query("SELECT * FROM categorie");
            while($s = $select->fetch(PDO::FETCH_OBJ)){
                ?>
            <option><?php echo $s->nom; ?></option>

            <?php } ?>

        </select><br><br>

        <h4>Prix :</h4><input type="text" name="prix"/><br>
        <h4>Stock :</h4><input type="text" name="stock"/><br><br>
        <input type="file" name="img"/><br><br>
        <input type="submit" name="submit"/>
    </form>


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
            $image_finale = $image_src;
            imagejpeg($image_finale,'imgs/'.$nom.'.jpg');
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
        
    }else{
        echo 'Veuillez rentrer une image';
    }
  
    
}

?>
