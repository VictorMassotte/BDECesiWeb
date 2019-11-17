<?php
session_start();
require_once('bdd.php');


if(isset($_SESSION['user_id'])){
    
}else{
    header('Location: http://localhost/BDECesiWeb/BDESite/Module_Connexion_Inscription/Connexion.php');
}


$erreur = false;

//Pour faire fonctionner notre panier nous allons utiliser en forme action/evenement en PHP

$action = (isset($_POST['action'])? $_POST['action']:  (isset($_GET['action'])? $_GET['action']:null )) ;
if($action !== null)
{
   if(!in_array($action,array('ajout', 'suppression', 'add', 'payer')))
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
//--------------------------------------------------------------------------------------------------------------
//Notre switch des actions à faire sur le panier
if (!$erreur){
   switch($action){
      Case "ajout": //Menu quand nous voulons ajouter un produti au panier

      $l = preg_replace('#\v#', '',$l);
      //On verifie que $p soit un float
      $p = floatval($p);

      $id_user = ($_SESSION['user_id']);
      $produit = $l;
      $quantite = $q;
      $prix = $p;
      
      $insert = $bdd->prepare("INSERT INTO panier (ID_USER, NOM_PRODUIT, QUANTITE, PRIX, PRIX_TOTAl) VALUES (:id_user, :produit, :quantite, :prix, :prix)");
      $insert->bindValue(':id_user', $id_user, PDO::PARAM_STR);
      $insert->bindValue(':produit', $produit, PDO::PARAM_STR);
      $insert->bindValue(':quantite', $quantite, PDO::PARAM_STR);
      $insert->bindValue(':prix', $prix, PDO::PARAM_STR);
      $insert->bindValue(':prix', $prix, PDO::PARAM_STR);
      $insert->execute();

      $insert_commande = $bdd->prepare("UPDATE produits SET NB_COMMANDE = NB_COMMANDE+1 WHERE NOM = :produit");
      $insert_commande->bindValue(':produit', $produit, PDO::PARAM_STR);
      $insert_commande->execute();

      header('Location: index.php');
      
   break;
   
   Case "suppression": // Menu quand nous voulons suppimer un article du panier

         $l = preg_replace('#\v#', '',$l);

         $id_user = ($_SESSION['user_id']);
         $produit = $l;
         
         $delete = $bdd->prepare("DELETE FROM panier WHERE NOM_PRODUIT =:produit AND ID_USER=:id_user");
         $delete->bindValue(':produit', $produit, PDO::PARAM_STR);
         $delete->bindValue(':id_user', $id_user, PDO::PARAM_STR);
         $delete->execute();

         $delete_commande = $bdd->prepare("UPDATE produits SET NB_COMMANDE = NB_COMMANDE-1 WHERE NOM = :produit");
         $delete_commande->bindValue(':produit', $produit, PDO::PARAM_STR);
         $delete_commande->execute();

         header('Location: index.php');

         break;

      Case "add" :  //Menu quand nous voulons ajouter une quantite à un article

      $l = preg_replace('#\v#', '',$l);

      $id_user = ($_SESSION['user_id']);
      $produit = $l;
      
      $delete = $bdd->prepare("UPDATE panier SET QUANTITE = QUANTITE+1 WHERE NOM_PRODUIT =:produit AND ID_USER=:id_user");
      $delete->bindValue(':produit', $produit, PDO::PARAM_STR);
      $delete->bindValue(':id_user', $id_user, PDO::PARAM_STR);
      $delete->execute();

      $total_article = $bdd->prepare("UPDATE panier SET PRIX_TOTAL=(SELECT PRIX * QUANTITE) WHERE ID_USER=:id_user");
      $total_article->bindValue(':id_user', $id_user, PDO::PARAM_STR);
      $total_article->execute();

      $update_commande = $bdd->prepare("UPDATE produits SET NB_COMMANDE = NB_COMMANDE+1 WHERE NOM = :produit");
      $update_commande->bindValue(':produit', $produit, PDO::PARAM_STR);
      $update_commande->execute();

      header('Location: panier.php');
      break;



      Default: //Et par default quand on arrive sur la page du panier mais sans rien faire

         $id_user = ($_SESSION['user_id']);
         $select_view = $bdd->prepare("SELECT * FROM panier WHERE ID_USER=:id_user");
         $select_view->bindValue(':id_user', $id_user, PDO::PARAM_STR);
         $select_view->execute();

         $id_user = ($_SESSION['user_id']);
         $paymentstock = $bdd->prepare("SELECT * FROM panier WHERE ID_USER=:id_user");
         $paymentstock->bindValue(':id_user', $id_user, PDO::PARAM_STR);
         $paymentstock->execute();

         $id_user = ($_SESSION['user_id']);
         $alltotal = $bdd->prepare("SELECT SUM(PRIX_TOTAL) AS TOTAL FROM panier WHERE ID_USER =:id_user");
         $alltotal->bindValue(':id_user', $id_user, PDO::PARAM_STR);
         $alltotal->execute();

         
         $id_user = ($_SESSION['user_id']);
         $compt_view = $bdd->prepare("SELECT * FROM panier WHERE ID_USER=:id_user");
         $compt_view->bindValue(':id_user', $id_user, PDO::PARAM_STR);
         $compt_view->execute();;

         //Verification sur le panier est vide. Et si il est vide, cela redirige vers la page accueil du site de la boutique
         $compt=$compt_view->fetchAll();

         if((count($compt) == 0)){
               header('Location: index.php');

         }
      
         
         break;
   }
}

?>

<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Boutique BDE CESI</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/jumbotron/">
    <script src="../js/jquery-3.4.1.min.js"></script>
    <link href="style/boutique.css" rel="stylesheet">
<?php include('../elements/menu.php');?>
  </head>
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

        while($s=$select_view->fetch(PDO::FETCH_OBJ)){

         ?>
         <form action="" method="POST">
            <ul class="list-group mb-3">
               <li class="list-group-item d-flex justify-content-between lh-condensed">
               <div>
                  <h6 class="my-0"><?php echo $s->NOM_PRODUIT; ?></h6>
               </div>
               <span class="text-muted"><?php echo $s->PRIX; ?>€</span>
               <a class="badge badge-primary text-center" href="panier.php?action=add&amp;l=<?php echo $s->NOM_PRODUIT ?>">Augmenter la quantité</a>
               
               <button type="button" class="btn btn-primary">Quantite :  <span class="badge badge-light"><?php echo $s->QUANTITE ?></span></button>

               <span class="text-muted"><a href="panier.php?action=suppression&amp;l=<?php echo $s->NOM_PRODUIT ?>">Supprimer l'article</a></span>
            </li>
            </ul>
         </form>
          <?php } 

         while($stotal=$alltotal->fetch(PDO::FETCH_OBJ)){
          
          ?>

         <li class="list-group-item d-flex justify-content-between">
          <span>Total</span>
          <strong><?php echo $stotal->TOTAL."€";?></strong>
        </li><br>

          <?php } ?>

            <a href="http://localhost/BDECesiWeb/BDESite/boutique/payment.php" type="submit" name="commander" class="btn btn-primary btn-lg btn-block" >Payer la commande </a>
            <br><br>
      <?php
         if(isset($_POST['commander'])){

            $update_stock = $bdd->prepare("UPDATE produits SET NB_COMMANDE = NB_COMMANDE+1 WHERE NOM = :produit");
            $update_stock->bindValue(':produit', $produit, PDO::PARAM_STR);
            $update_stock->execute();
      
            header($paypal);
          }
      
	?>
</form>
</html>

<?php require_once('../elements/footer.php'); ?>
