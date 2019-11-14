<?php

session_start();

require_once('bdd.php');
require('../../vendor/autoload.php');

if(isset($_SESSION['user_id'])){
    
}else{
    header('Location: http://localhost/BDECesiWeb/BDESite/Module_Connexion_Inscription/Connexion.php');
}

$ids = require('paypal.php');

$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        $ids['id'],
        $ids['secret']

    )
);

$id_user = ($_SESSION['user_id']);
$select_view = $bdd->prepare("SELECT * FROM panier WHERE ID_USER=:id_user");
$select_view->bindValue(':id_user', $id_user, PDO::PARAM_STR);
$select_view->execute();

$list = new \PayPal\Api\ItemList();

while($s=$select_view->fetch(PDO::FETCH_OBJ)){
    $item = (new \PayPal\Api\Item())
        ->setName($s->NOM_PRODUIT)
        ->setPrice($s->PRIX)
        ->setCurrency('EUR')
        ->setQuantity($s->QUANTITE);

$list->addItem($item);

}

$id_user = ($_SESSION['user_id']);
$alltotal = $bdd->prepare("SELECT SUM(PRIX_TOTAL) AS TOTAL FROM panier WHERE ID_USER =:id_user");
$alltotal->bindValue(':id_user', $id_user, PDO::PARAM_STR);
$alltotal->execute();

while($stotal=$alltotal->fetch(PDO::FETCH_OBJ)){
    $amount = (new \PayPal\Api\Amount())
        ->setTotal($stotal->TOTAL)
        ->setCurrency("EUR");

}

$transaction = (new \PayPal\Api\Transaction())
    ->setItemList($list)
    ->setDescription('Achat sur le site du BDE CESI')
    ->setAmount($amount);

$payment = new \PayPal\Api\Payment();
$payment->setTransactions([$transaction]);
$payment->setIntent('sale');

$redirectUrls = (new \PayPal\Api\RedirectUrls())
    ->setReturnUrl('http://localhost/BDECesiWeb/BDESite/boutique/success.php')
    ->setCancelUrl('http://localhost/BDECesiWeb/BDESite/boutique/panier.php');
$payment->setRedirectUrls($redirectUrls);

$payment->setPayer((new \PayPal\Api\Payer())->setPaymentMethod('paypal'));

try{
    $payment->create($apiContext);
    header('Location:' .$payment->getApprovalLink());
}catch(\PayPal\Exception\PayPalConnectionException $e){
    var_dump(json_decode($e->getData()));
}


?>