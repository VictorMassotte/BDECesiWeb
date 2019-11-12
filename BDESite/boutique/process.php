<?php

session_start();
include_once("fonctions_panier.php");
include_once("paypal.php");
include_once('bdd.php');

$total = MontantGlobal();
$paypal = new Paypal();
$response = $paypal->request('GetExpressCheckoutDetails', array(
    'TOKEN' => $_GET['token']
));

if($response){

    if($response['CHECKOUTSTATUS'] == 'PaymentActionCompleted'){
        header('Location: index.php');
    }

}else{
    var_dump($paypal->errors);
    die();

}

$response = $paypal->request('DoExpressCheckoutPayment', array(
    'TOKEN' => $_GET['token'],
    'PAYERID' => $_GET['PayerID'],
    'PAYMENTACTION' => 'Sale',
    'PAYMENTREQUEST_0_AMT' => $total,
    'PAYMENTREQUEST_0_CURRENCYCODE' => 'EUR'
    
));

if($response){
   header('Location: success.php');

}else{
    var_dump($paypal->errors);
    die();
}

?>