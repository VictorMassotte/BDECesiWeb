
  <?php

session_start();
require_once('../boutique/bdd.php');

$id_user = ($_SESSION['user_id']);
         $compt_menu = $bdd->prepare("SELECT * FROM panier WHERE ID_USER=:id_user");
         $compt_menu->bindValue(':id_user', $id_user, PDO::PARAM_STR);
         $compt_menu->execute();;

         $comptmenu=$compt_menu->fetchAll();

?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="menu.css">
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>  
 
 
 <nav class="navbar navbar-expand-lg fixed-top text-center allmenu">
  <a class="navbar-brand" href="#"><img src="https://cdn.discordapp.com/attachments/641626180298080257/644919171494314006/logo_cesi_blanc.png" class="custom-logo" alt="CESI École d'ingénieurs" width="200" height="65"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>



  <div class="collapse navbar-collapse " id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link textmenu" href="http://localhost/BDECesiWeb/BDESite/boutique/">Boutique</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle textmenu" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Manifestations
        </a>
        <div class="dropdown-menu sousmenu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item  barremenu"   href="http://localhost/BDECesiWeb/BDESite/manifestation/manifpasse.php">Manifestations passées</a>
          <a class="dropdown-item  barremenu" href="http://localhost/BDECesiWeb/BDESite/manifestation/manifavenir.php">Manifestation à venir</a>
          <a class="dropdown-item  barremenu" href="http://localhost/BDECesiWeb/BDESite/manifestation/listePhoto.php">Liste de toutes les photos</a>
        </div>
      </li>

      <?php if(isset($_SESSION['membre_BDE'])) { ?>

        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle textmenu" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Panel Admin
        </a>
        <div class="dropdown-menu sousmenu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item  barremenu" href="http://localhost/BDECesiWeb/BDESite/manifestation/manifavenir.php">Administration Manifestation</a>
          <a class="dropdown-item  barremenu" href="http://localhost/BDECesiWeb/BDESite/manifestation/manifavenir.php">Administration Manifestation</a>
        </div>
      </li>

     <?php } ?>
     


      <li class="nav-item my-2 my-lg-0">
        <a class="nav-link textmenu" href="#">Contact</a>
      </li>
      
      <li class="nav-item my-2 my-lg-0">
      <a class="nav-link textmenu" href="http://localhost/BDECesiWeb/BDESite/boutique/panier.php">
        Mon Panier <span class="badge badge-light"><?php echo count($comptmenu) ?></span>
      </a>
      </li>
    </ul>
      <ul class="nav justify-content-end navbar-nav">
      <li class="nav-item nform-inline justify-content-end">
        <a class="nav-link mr-sm-2 textmenu" href="http://localhost/BDECesiWeb/BDESite/Module_Connexion_Inscription/Deconnexion.php">Deconnexion</a>
      </li>

    </ul>
  </div>
</nav>



<?php require_once('footer.php'); ?>


