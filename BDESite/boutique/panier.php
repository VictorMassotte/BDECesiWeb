<?php
session_start();
include_once("fonctions_panier.php");
include_once("paypal.php");
require_once('../elements/menu.php');


$erreur = false;

$action = (isset($_POST['action'])? $_POST['action']:  (isset($_GET['action'])? $_GET['action']:null )) ;
if($action !== null)
{
   if(!in_array($action,array('ajout', 'suppression', 'refresh')))
   $erreur=true;

   //récuperation des variables en POST ou GET
   $l = (isset($_POST['l'])? $_POST['l']:  (isset($_GET['l'])? $_GET['l']:null )) ;
   $p = (isset($_POST['p'])? $_POST['p']:  (isset($_GET['p'])? $_GET['p']:null )) ;
   $q = (isset($_POST['q'])? $_POST['q']:  (isset($_GET['q'])? $_GET['q']:null )) ;

   //Suppression des espaces verticaux
   $l = preg_replace('#\v#', '',$l);
   //On verifie que $p soit un float
   $p = floatval($p);

   //On traite $q qui peut etre un entier simple ou un tableau d'entier
    
   if (is_array($q)){
      $QteArticle = array();
      $i=0;
      foreach ($q as $contenu){
         $QteArticle[$i++] = intval($contenu);
      }
   }
   else
   $q = intval($q);
    
}

if (!$erreur){
   switch($action){
      Case "ajout":
         ajouterArticle($l,$q,$p);
         break;

      Case "suppression":
         supprimerArticle($l);
         break;

      Case "refresh" :
         for ($i = 0 ; $i < count($QteArticle) ; $i++)
         {
            modifierQTeArticle($_SESSION['panier']['libelleProduit'][$i],round($QteArticle[$i]));
         }
         break;

      Default:
         break;
   }
}

?>

<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Boutique BDE CESI</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/jumbotron/">
    <link href="jumbotron.css" rel="stylesheet">
    <link href="style/boutique.css" rel="stylesheet">

  </head>


<br><br><br>
<div class="jumbotron">
  <div class="container">
    <h1 class="display-3">Boutique du BDE CESI</h1>
    </div>
</div>


<form class="panier" method="post" action="panier.php">
   <div class="col-md">
      <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted">Votre Panier</span>
      </h4><hr>


	<?php
    if (creationPanier())

	{

	   $nbArticles=count($_SESSION['panier']['libelleProduit']);
	   if ($nbArticles <= 0)
	   echo "<tr><td>Votre panier est vide </ td></tr>";
	   else
	   {
        
        $total = MontantGlobal();
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

	      for ($i=0 ;$i < $nbArticles ; $i++)
	      {

            ?>

            <ul class="list-group mb-3">
               <li class="list-group-item d-flex justify-content-between lh-condensed">
               <div>
                  <h6 class="my-0"><?php echo $_SESSION['panier']['libelleProduit'][$i]; ?></h6>
                     <small class="text-muted">Quantite</small>
                     <small class="text-muted"><input name="q[]" value="<?php echo $_SESSION['panier']['qteProduit'][$i]; ?>" size="5"/></small>
               </div>
               <span class="text-muted"><?php echo $_SESSION['panier']['prixProduit'][$i]; ?>€</span>
               <span class="text-muted"><a href="panier.php?action=suppression&amp;l=<?php echo rawurlencode($_SESSION['panier']['libelleProduit'][$i]); ?>">Supprimer l'article</a></span>
            </li>
          <?php } ?>

         <li class="list-group-item d-flex justify-content-between">
          <span>Total</span>
          <strong><?php echo $total."€";?></strong>
        </li>
        <li class="list-group-item d-flex">
        <div class="input-group-append">
               <button type="submit" class="btn btn-secondary">Rafraichir le panier</button>
               <input type="hidden" name="action" value="refresh"/>
         </div>
        </li>
                <?php
                
                if(isset($_SESSION['user_id'])){

                 ?>
               <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>
               <a class="btn btn-primary btn-lg btn-block "href="<?php echo $paypal; ?>">Payer la commande </a>
                <?php } else{ ?>
                  <h4 class="btn btn-danger btn-lg btn-block" class="panier">Vous devez etre connecté pour payer !</h4>
                  <?php } ?>
              </td>

            <?php

       }
    }

	?>
</form>
