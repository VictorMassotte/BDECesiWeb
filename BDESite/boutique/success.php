<?php
session_start();
require_once('bdd.php');
include_once("fonctions_panier.php");
require('../../vendor/autoload.php');

$ids = require('paypal.php');


if(isset($_SESSION['user_id'])){
    
}else{
    header('Location: http://localhost/BDECesiWeb/BDESite/Module_Connexion_Inscription/Connexion.php');
}

$apiContext = new \PayPal\Rest\ApiContext(
  new \PayPal\Auth\OAuthTokenCredential(
      $ids['id'],
      $ids['secret']

  )
);

$payment = \PayPal\Api\Payment::get($_GET['paymentId'], $apiContext);

$execution = (new \PayPal\Api\PaymentExecution())
  ->setPayerId($_GET['PayerID'])
  ->setTransactions($payment->getTransactions());



try{
  $payment->execute($execution, $apiContext);
  var_dump($payment->getTransactions()[0]->getCustom());
  var_dump($payment);
}catch(\PayPal\Exception\PayPalConnectionException $e){
  var_dump(json_decode($e->getData()));
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
$delete = $bdd->prepare("DELETE FROM panier WHERE ID_USER =:id_user");
$delete->bindValue(':id_user', $id_user, PDO::PARAM_STR);
$delete->execute();


?>