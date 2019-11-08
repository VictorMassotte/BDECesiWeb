<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<h1>Bienvenue sur la boutique</h1>

<?php

include('bdd.php'); 

$select = $bdd->prepare('SELECT * FROM produits');
$select->execute();

while($s=$select->fetch(PDO::FETCH_OBJ)){

    ?>
    <h2><?php echo $s->NOM;?></h2>
    <h3><?php echo $s->DESCRIPTION; ?></h3>
    <h3><?php echo $s->PRIX; ?>€</h3><br>

<?php
}
?>