<?php

session_start();
include_once("fonctions_panier.php");
include_once("paypal.php");
include_once('bdd.php');

$_SESSION['user_id'] = '1';
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
    'PAYMENTREQUEST_0_CURRENCYCODE' => 'EUR',
    'PAYMENTREQUEST_0_TRANSACTIONID' => 'TRANSACTIONID'
    
));

if($response){

    $response2 = $paypal->request('GetTransactionDetais', array(
        'TRANSACTIONID' => $response['PAYMENTREQUEST_0_TRANSACTIONID']
    ));

    $product = '';

    for($i = 0; $i<count($_SESSION['panier']['libelleProduit']); $i++){
        $product.=$_SESSION['panier']['libelleProduit'][$i];

        if(count($_SESSION['panier']['libelleProduit'])>1){
            $product.=', ';
        }
    }

    $nom = $response2['SHIPTONAME'];
    $date = $response2['ORDERTIME'];
    $transaction_id = $response2['TRANSACTIONID'];
    $amt = $response2['AMT'];
    $user_id = $response2['user_id'];

   $bdd->query("INSERT INTO transaction VALUES('', '$nom','$date', '$transaction_id', '$amt', '$product', '$user_id')");

   header('Location: success.php');

}else{
    var_dump($paypal->errors);
    die();
}

?>