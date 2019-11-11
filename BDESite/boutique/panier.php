<?php
session_start();
include_once("fonctions_panier.php");
include_once("paypal.php");

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

<form method="post" action="panier.php">
<table style="width: 500px">
	<tr>
		<td colspan="1">Votre panier</td>
	</tr>
	<tr>
        <td>Nom du Produit</td>
        <td>Prix d'un element</td>
		<td>Quantité</td><br>
		<td>Action</td>
	</tr>

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
            
	         <tr>
                 <td><br><?php echo $_SESSION['panier']['libelleProduit'][$i]; ?></td>
                 <td><br><?php echo $_SESSION['panier']['prixProduit'][$i]; ?></td>
                 <td><br><input name="q[]" value="<?php echo $_SESSION['panier']['qteProduit'][$i]; ?>" size="5"/></td>
                 <td><br><a href="panier.php?action=suppression&amp;l=<?php echo rawurlencode($_SESSION['panier']['libelleProduit'][$i]); ?>">Supprimer Article</a></td>
	         </tr>
          <?php } ?>
          
          <tr>
              <td colspan="2"><br>
                <p>Total du panier : <?php echo $total."€";?></p>
                <?php
                
                if(isset($_SESSION['user_id'])){

                 ?>
               <a href="<?php echo $paypal; ?>">Payer la commande </a>
                <?php } else{ ?>
                  <h4>Vous devez etre connecté pour payer !</h4>
                  <?php } ?>
              </td>
          </tr>

          <tr>
              <td colspan="3">
                  <input type="submit" value="rafraichir"/>
                  <input type="hidden" name="action" value="refresh"/>
              </td>
          </tr>
          <?php

       }
    }

	?>
</table>
</form>
