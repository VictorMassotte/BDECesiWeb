<?php

session_start();
require_once('bdd.php');
include('../elements/menu.php');

if(isset($_SESSION['user_id'])){
    
}else{
    header('Location: http://localhost/BDECesiWeb/BDESite/Module_Connexion_Inscription/Connexion.php');
}


?>

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


<br><br><br>
<div class="jumbotron">
       <h1 class="display-4">Boutique BDE CESI</h1>
    </div>
  
<?php

if(isset($_GET['show'])){
    
    $product = $_GET['show'];
    
    $select = $bdd->prepare('SELECT * FROM produits WHERE NOM=:produit');
    $select->bindValue(':produit', $product, PDO::PARAM_STR);
    $select->execute();
    
    $s = $select->fetch(PDO::FETCH_OBJ);

    
    ?>

        <div class="card mb-5 testhidden" style="max-width: 1920px;">
        <div class="row no-gutters">
            <div class="col-md-4">
            <img src="admin/imgs/<?php echo $s->ID; ?>.jpg" class="card-img" alt="Photo Produit">
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
    <form class="text-center" action="" method="POST">
        <button type="submit" name="asc" class="btn btn-secondary">Trier produit par le prix croissant</button>
        <button type="submit" name="dsc" class="btn btn-secondary">Trier produit par le prix decroissant</button>
</form><br>

<section class="text-center">
<ul class="nav justify-content-center">
<form class="form-inline my-2 my-lg-0 " method="POST">
      <input class=" text-center form-control mr-sm-2" type="search" name="search" placeholder="Rechercher un produit" aria-label="Search">
      <button class=" text-center btn btn-outline-success my-2 my-sm-0" name="submit_search" type="submit">Rechercher</button>
    </section>
</form>
    </ul>
    
</section>
    


        <?php

            if(isset($_POST['asc'])){
                $select_trier =$bdd->prepare("SELECT * FROM `produits` WHERE CATEGORIE=:categorie ORDER BY `produits`.`PRIX` ASC");
                $select_trier->bindValue(':categorie', $categorie, PDO::PARAM_STR);
                $select_trier->execute();

                while($trier=$select_trier->fetch(PDO::FETCH_OBJ)){
                ?>
                    <ul class="wrapper">
                    <li class="test">
                    <div class="card" style="width: 18rem;">
                    <img src="admin/imgs/<?php echo $trier->ID; ?>.jpg" class="card-img-top" alt="Photo Produit">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $trier->NOM; ?></h5>
                        <p class="card-text"><?php echo $trier->PRIX; ?>€</p>
                        <a href="?show=<?php echo $trier->NOM; ?>" class="card-link">Voir plus de details</a><br><br>
                        <?php
                     if($trier->STOCK!=0){?><a  class="btn btn-primary" href="panier.php?action=ajout&amp;l=<?php echo $trier->NOM; ?>&amp;q=1&amp;p=<?php echo $trier->PRIX; ?>">Ajouter au panier</a><br><br>
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
                
            }elseif(isset($_POST['dsc'])){


                $select_trier =$bdd->prepare("SELECT * FROM `produits` WHERE CATEGORIE=:categorie ORDER BY `produits`.`PRIX` DESC");
                $select_trier->bindValue(':categorie', $categorie, PDO::PARAM_STR);
                $select_trier->execute();

                while($trier=$select_trier->fetch(PDO::FETCH_OBJ)){
                ?>
                    <ul class="wrapper">
                    <li class="test">
                    <div class="card" style="width: 18rem;">
                    <img src="admin/imgs/<?php echo $trier->ID; ?>.jpg" class="card-img-top" alt="Photo Produit">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $trier->NOM; ?></h5>
                        <p class="card-text"><?php echo $trier->PRIX; ?>€</p>
                        <a href="?show=<?php echo $trier->NOM; ?>" class="card-link">Voir plus de details</a><br><br>
                        <?php
                     if($trier->STOCK!=0){?><a  class="btn btn-primary" href="panier.php?action=ajout&amp;l=<?php echo $trier->NOM; ?>&amp;q=1&amp;p=<?php echo $trier->PRIX; ?>">Ajouter au panier</a><br><br>
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

            }elseif(isset($_POST['submit_search'])){

                $search = $_POST['search'];
                $select_search =$bdd->prepare("SELECT * FROM produits WHERE NOM LIKE CONCAT ('%',:search,'%')");
                $select_search->bindValue(':search',$search, PDO::PARAM_STR);
                $select_search->execute();

                while($sea=$select_search->fetch(PDO::FETCH_OBJ)){
                ?>
                    <ul class="wrapper">
                    <li class="test">
                    <div class="card" style="width: 18rem;">
                    <img src="admin/imgs/<?php echo $sea->ID; ?>.jpg" class="card-img-top" alt="Photo Produit">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $sea->NOM; ?></h5>
                        <p class="card-text"><?php echo $sea->PRIX; ?>€</p>
                        <a href="?show=<?php echo $sea->NOM; ?>" class="card-link">Voir plus de details</a><br><br>
                        <?php
                     if($sea->STOCK!=0){?><a  class="btn btn-primary" href="panier.php?action=ajout&amp;l=<?php echo $sea->NOM; ?>&amp;q=1&amp;p=<?php echo $sea->PRIX; ?>">Ajouter au panier</a><br><br>
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

                while($s=$select->fetch(PDO::FETCH_OBJ)){
            
                    ?>
        
                <ul class="wrapper">
                    <li class="test">
                    <div class="card" style="width: 18rem;">
                    <img src="admin/imgs/<?php echo $s->ID; ?>.jpg" class="card-img-top" alt="Photo Produit">
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

            }
        
    }else{
        
        $select = $bdd->prepare('SELECT * FROM categorie');
        $select->execute();
        
        while($s=$select->fetch(PDO::FETCH_OBJ)){
            
            ?>
            <div class="container text-center">
            <h2>
                <?php echo $s->nom ?>
            </h2>
            <p><a class="btn btn-secondary" href="?categorie=<?php echo $s->nom; ?>" role="button">Plus de details &raquo;</a></p>
            </div>
            

            <?php
        }
        
    }
}

 $top = $bdd->prepare("SELECT * FROM `produits` ORDER BY `produits`.`NB_COMMANDE` DESC LIMIT 3");
 $top->execute();

 ?>
<section class="topventehidden">
<hr> <h5 class="text-center ">Top des ventes</h5><br>
<div class="card-deck">

<?php

while($tops=$top->fetch(PDO::FETCH_OBJ)){

   ?>


   <div class="card text-center ">
     <center><img src="admin/imgs/<?php echo $tops->ID; ?>.jpg" class="card-img" alt="Photo Produit" style="width: 18rem; height: 18rem;"></center>
     <div class="card-body">
       <h5 class="card-title "><?php echo $tops->NOM; ?></h5>
       <a href="?show=<?php echo $tops->NOM; ?>" class="card-link">Voir plus de details</a><br><br>
       <?php
                    if($tops->STOCK!=0){?><a  class="btn btn-primary" href="panier.php?action=ajout&amp;l=<?php echo $tops->NOM; ?>&amp;q=1&amp;p=<?php echo $tops->PRIX; ?>">Ajouter au panier</a><br><br>
                       <?php
                   }else{
                       echo'<h5>Stock épuisé ! </h5>';
                   }
                   ?>
     </div>
   </div>



<?php
}

?>

</div><br><br>
</section>
</main>
</body>



<?php


require_once('../elements/footer.php');

?>
</html>
<style>
    .topventehidden{
        overflow:hidden;
    }


</style>
