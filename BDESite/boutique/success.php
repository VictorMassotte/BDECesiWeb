<?php
session_start();
require_once('bdd.php');
include_once("fonctions_panier.php");
include_once("paypal.php");

if(isset($_SESSION['user_id'])){
    
}else{
    header('Location: http://localhost/BDECesiWeb/BDESite/Module_Connexion_Inscription/Connexion.php');
}

?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>  

<div class="jumbotron text-center">
  <h1 class="display-3">Merci beaucoup</h1>
  <p class="lead"><strong>Merci de consulter vos emails. </strong> Pour plus d'informations sur votre commande</p>
  <hr>
  <p class="lead">
    <a class="btn btn-primary btn-sm" href="http://localhost/BDECesiWeb/BDESite/boutique/" role="button">Retour à la boutique</a>
  </p>
</div>


<?php

$id_user = ($_SESSION['user_id']);
$update = $bdd->prepare("UPDATE produits SET NB_COMMANDE = NB_COMMANDE+1 WHERE NOM = :produit");
$update->bindValue(':produit', $produit, PDO::PARAM_STR);
$update->execute();

$delete = $bdd->prepare("DELETE FROM panier WHERE USER_ID =:user_id");
$delete->bindValue(':id_user', $id_user, PDO::PARAM_STR);
$delete->execute();


?>