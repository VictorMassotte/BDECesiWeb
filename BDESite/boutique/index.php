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
<main>

<?php require_once('../elements/menu.php'); ?>

<br><br><br>
<div class="jumbotron">
       <h1 class="display-4">Boutique BDE CESI</h1>
    </div>
  
<?php

require_once('admin/verif.php');
require_once('bdd.php');


if(isset($_GET['show'])){
    
    $product = $_GET['show'];
    
    $select = $bdd->prepare('SELECT * FROM produits WHERE NOM=:produit');
    $select->bindValue(':produit', $product, PDO::PARAM_STR);
    $select->execute();
    
    $s = $select->fetch(PDO::FETCH_OBJ);

    
    ?>

        <div class="card mb-5" style="max-width: 2000px;">
        <div class="row no-gutters">
            <div class="col-md-4">
            <img src="admin/imgs/<?php echo $s->NOM; ?>.jpg" class="card-img" alt="Photo Produit">
            </div>
            <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title"><?php echo $s->NOM; ?></h5>
                <p class="card-text">Description du Produit: <?php echo $s->DESCRIPTION; ?></p>
                <p class="card-text"><?php echo $s->PRIX; ?>€</p>
                
                <?php
                if($s->STOCK!=0){?><a  class="btn btn-primary" href="panier.php?action=ajout&amp;l=<?php echo $s->NOM; ?>&amp;q=1&amp;p=<?php echo $s->PRIX; ?>">Ajouter au panier</a><br><br>
                    <?php
                }else{
                    echo'<h5>Stock épuisé ! </h5>';
                } ?>
            </div>
            </div>
        </div>
        </div>
    <?php

    
}else{
    
    if(isset($_GET['categorie'])){
        
        $categorie = $_GET['categorie'];
        $select = $bdd->prepare('SELECT * FROM produits WHERE CATEGORIE=:categorie');
        $select->bindValue(':categorie', $categorie, PDO::PARAM_STR);
        $select->execute();
        
        ?>

<div class="search-bar">
        <input class="searchinbar" type="text" name="search" value="" id="myinput" onkeyup="searchFunction()" placeholder="Rechercher un vehicule">
    </div> 

        <?php
        while($s=$select->fetch(PDO::FETCH_OBJ)){
            
            ?>

        <ul class="wrapper">
            <li class="test">
            <div class="card" style="width: 18rem;">
            <img src="admin/imgs/<?php echo $s->NOM; ?>.jpg" class="card-img-top" alt="Photo Produit">
            <div class="card-body">
                <h5 class="card-title"><?php echo $s->NOM; ?></h5>
                <p class="card-text"><?php echo $s->PRIX; ?>€</p>
                <a href="?show=<?php echo $s->NOM; ?>" class="card-link">Voir plus de details</a><br><br>
                <?php
             if($s->STOCK!=0){?><a  class="btn btn-primary" href="panier.php?action=ajout&amp;l=<?php echo $s->NOM; ?>&amp;q=1&amp;p=<?php echo $s->PRIX; ?>">Ajouter au panier</a><br><br>
                <?php
            }else{
                echo'<h5>Stock épuisé ! </h5>';
            }
            ?>
            </div>
            </div>
            </li>
        </ul>

<?php
        }
        
    }else{
        
        $select = $bdd->prepare('SELECT * FROM categorie');
        $select->execute();
        
        while($s=$select->fetch(PDO::FETCH_OBJ)){
            
            ?>
            <div class="container">
            <div class="row">
            <div class="col-md-2">
            <h2>
                <?php echo $s->nom ?>
            </h2>
            <p><a class="btn btn-secondary" href="?categorie=<?php echo $s->nom; ?>" role="button">Plus de details &raquo;</a></p>
            </div>
            </div>
            </div>
            
    </main>
</body>
            <?php
        }
        
    }
}

require_once('../elements/footer.php');

?>