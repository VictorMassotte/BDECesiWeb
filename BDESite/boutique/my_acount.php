<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<h1>Sauvegardes Panier</h1>

<?php 
session_start();
include_once("paypal.php");
include('bdd.php');

$user_id = $_SESSION['user_id'];

$select = $bdd->prepare('SELECT * FROM save_pannier WHERE USER_ID=:user_id');
$select->bindValue(':user_id', $user_id, PDO::PARAM_STR);
$select->execute();


while($s=$select->fetch(PDO::FETCH_OBJ)){

    echo $s->NOM;
    ?>

    <a href="?action=charger&amp;id=<?php echo $s->ID; ?>">Charger</a>

<?php
}

if(isset ($_GET['action'])){  
    
    if($_GET['action'] == "charger"){

        $id = $_GET['id'];
        $select = $bdd->prepare('SELECT * FROM save_pannier WHERE ID=:id');
        $select->bindValue(':id', $id, PDO::PARAM_STR);
        $select->execute();

        $data = $select->fetch(PDO::FETCH_OBJ);

        $total = $data->MONTANT;
        $paypal = new Paypal();

        $params = array(

            'RETURNURL' => 'http://127.0.0.1/BDECesiWeb/BDESite/boutique/process.php',
            'CANCELURL' => 'http://127.0.0.1/BDECesiWeb/BDESite/boutique/cancel.php',
            'PAYMENTREQUEST_0_AMT' => $total,
            'PAYMENTREQUEST_0_CURRENCYCODE' => 'EUR'

        );

        $response = $paypal->request('SetExpressCheckout', $params);

        if($response){

         $paypal = 'https://sandbox.paypal.com/webscr?cmd=_express-checkout&useraction=commit&token='.$response['TOKEN'].'';

        }else{
         var_dump($paypal->$errors);
           die('Erreur');

        }



       

    }?>

<form method="post" action="">
    <h4>Nom :</h4><p><?php echo $data->NOM; ?></p>
    <h4>Produit :</h4><p><?php echo $data->PRODUIT; ?></p>
    <h4>Prix :</h4><p><?php echo $data->MONTANT; ?>€</p>
    <a class="btn btn-primary btn-lg btn-block "href="<?php echo $paypal; ?>">Payer la commande </a>
</form>

    <?php
    

    
    }
    ?>
