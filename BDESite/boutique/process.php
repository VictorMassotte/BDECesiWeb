<?php
require_once("fonctions_panier.php");
require_once("paypal.php");
require_once('bdd.php');

$total = MontantGlobal();
$paypal = new Paypal();
$response = $paypal->request('GetExpressCheckoutDetails', array(
    'TOKEN' => $_GET['token']
));

if($response){
    
    if($response['CHECKOUTSTATUS'] == 'PaymentActionCompleted'){
        die('Ce paiment est Ok !');
        //header('Location: index.php');
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
    
    var_dump($response);
    //unset($_SESSION['panier']);
    //header("Refresh:0; url=success.php");
    
    
}else{
    var_dump($paypal->errors);
    die();
}

?>