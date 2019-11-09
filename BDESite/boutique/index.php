<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<h1>Bienvenue sur la boutique</h1>

<?php

include('bdd.php'); 

if(isset($_GET['categorie'])){
    
    $categorie = $_GET['categorie'];
    $select = $bdd->prepare('SELECT * FROM produits WHERE CATEGORIE=:categorie');
    $select->bindValue(':categorie', $categorie, PDO::PARAM_STR);
    $select->execute();
    
    
    while($s=$select->fetch(PDO::FETCH_OBJ)){
        
        ?>
        <img src="admin/imgs/<?php echo $s->NOM; ?>.jpg"/>
        <h2><?php echo $s->NOM;?></h2>
        <h3><?php echo $s->DESCRIPTION; ?></h3>
        <h3><?php echo $s->PRIX; ?>€</h3><br>
        <?php
    }
    
}else{

    $select = $bdd->prepare('SELECT * FROM categorie');
    $select->execute();
    
    while($s=$select->fetch(PDO::FETCH_OBJ)){
        
        ?>
        <a href="?categorie=<?php echo $s->nom; ?>"><h3><?php echo $s->nom ?></h3></a>
        
        <?php
    }
    
}

?>