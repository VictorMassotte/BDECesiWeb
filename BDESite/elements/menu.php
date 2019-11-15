
  <?php

$id_user = ($_SESSION['user_id']);
         $compt_menu = $bdd->prepare("SELECT * FROM panier WHERE ID_USER=:id_user");
         $compt_menu->bindValue(':id_user', $id_user, PDO::PARAM_STR);
         $compt_menu->execute();;

         $comptmenu=$compt_menu->fetchAll();

?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>  
 
 
 <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <a class="navbar-brand" href="#"><img src="https://ecole-ingenieurs.cesi.fr/wp-content/uploads/sites/5/2018/10/logo-cesi-ecole-ingenieurs.png" class="custom-logo" alt="CESI École d'ingénieurs" width="200" height="55"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>



  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="http://localhost/BDECesiWeb/BDESite/boutique/">Boutique</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Manifestations
        </a>
        <div class="dropdown-menu navbar-dark" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="http://localhost/BDECesiWeb/BDESite/manifestation/manifpasse.php">Manifestations passées</a>
          <a class="dropdown-item" href="http://localhost/BDECesiWeb/BDESite/manifestation/manifavenir.php">Manifestation à venir</a>
          <a class="dropdown-item" href="http://localhost/BDECesiWeb/BDESite/manifestation/photo.php">Liste de toutes les photos</a>
        </div>
      </li>
      <li class="nav-item my-2 my-lg-0">
        <a class="nav-link" href="#">Mon profil</a>
      </li>
      <?php if(isset($_SESSION['membre_BDE'])) { ?>

        <li class="nav-item my-2 my-lg-0">
        <a class="nav-link" href="http://localhost/BDECesiWeb/BDESite/boutique/admin/admin.php">Page Administration Boutique</a>
        </li>
        <li class="nav-item my-2 my-lg-0">
        <a class="nav-link" href="http://localhost/BDECesiWeb/BDESite/admin/admin.php">Page Administration Manifestation</a>
        </li>

     <?php } ?>
     
      <li class="nav-item my-2 my-lg-0">
        <a class="nav-link" href="http://localhost/BDECesiWeb/BDESite/Module_Connexion_Inscription/Deconnexion.php">Deconnexion</a>
      </li>

      <li class="nav-item my-2 my-lg-0">
        <a class="nav-link" href="#">Contact</a>
      </li>



      <button type="hiden" class="btn btn-dark"><a href="http://localhost/BDECesiWeb/BDESite/boutique/panier.php">
        Mon Panier </a><span class="badge badge-light"><?php echo count($comptmenu) ?></span>
      </button>

    </ul>
  </div>
</nav>


