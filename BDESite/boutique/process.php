<?php

session_start();
include_once("fonctions_panier.php");
include_once("paypal.php");
include_once('bdd.php');

//$_SESSION['user_id'] = '1';

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

    /*$response2 =$paypal->request('GetTransactionDetails', array(
        'TRANSACTIONID'=> $response('PAYMENTREQUEST_0_TRANSACTIONID')
    ));

    $produit = '';

    for($i = 0;$i<count($_SESSION['panier']['libelleProduit']); $i++){
        $produit = $_SESSION['panier']['libelleProduit'][$i];

        if(count($_SESSION['panier']['libelleProduit']) > 1){
            $produit = ', ';
        }
    }

    $name = $response2['SHIPTONAME'];
    $date = $response2['ORDERTIME'];
    $transaction_id = $response2['TRANSACTIONID'];
    $amt = $response2['AMT'];
    $user_id = $_SESSION['user_id'];

    $insert =$bdd->prepare(INSERT INTO `transaction` (`ID`, `NOM`, `DATE`, `TRANSACTION_ID`, `AMOUNT`, `PRODUITS`, `USER_ID`) VALUES (NULL, ':nom', ':date', ':transaction', ':amt', ':produit', ':user')

    $insert->bindValue(':nom', $name, PDO::PARAM_STR);
    $insert->bindValue(':date', $date, PDO::PARAM_STR);
    $insert->bindValue(':transaction', $transaction_id, PDO::PARAM_STR);
    $insert->bindValue(':amt', $amt, PDO::PARAM_STR);
    $insert->bindValue(':produit', $produit, PDO::PARAM_STR);
    $insert->bindValue(':user', $user_id, PDO::PARAM_STR);
    $insert->execute();*/

    var_dump($response);
    unset($_SESSION['panier']);
    header("Refresh:0; url=success.php");
    

}else{
    var_dump($paypal->errors);
    die();
}

?>