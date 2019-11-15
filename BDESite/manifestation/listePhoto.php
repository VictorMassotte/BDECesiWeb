<?php
session_start();
if(isset($_SESSION['login'])){
    include('../boutique/bdd.php');
}else{
    header('Location: ../Module_Connexion_Inscription/Connexion.php');
}?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../js/signalerPhoto.js"></script>
        
        
        <link rel="stylesheet" href="css/fonction.css">
        <title>Evenements passés</title>
</head>
<body>
    <header>
        <!--en tête-->
        <!--menu-->
    </header>

<h1>Liste des photos</h1>
<form method="post" enctype="multipart/form-data" action="" >
<h4>Manifestation</h4>
<select name="manif" required>
<?php $rqt = $bdd->query('SELECT manifestations.ID ,NOM,DATEE FROM manifestations INNER JOIN ajouter_photo ON manifestations.ID=ajouter_photo.ID ORDER BY DATEE desc ');

while ($ligne = $rqt->fetch()) {
    
    
    
    $dateactuelle = new DateTime('now');
    $datetime1 = new DateTime($ligne['DATEE']);
    $interval = $datetime1->diff($dateactuelle);
    $nom_manif=$ligne['NOM'];
        echo "<option value=\"".$nom_manif."\">".$nom_manif."</option>";
}?>

</select> 

<input type="submit" name="submit"/>
</form>
<?php
if(isset($_POST['submit'])){
$nom = $_POST['manif'];
$select = $bdd->prepare('SELECT * FROM ajouter_photo INNER JOIN manifestations ON manifestations.ID=ajouter_photo.ID WHERE NOM=:im');
$select->bindValue(':im', $nom, PDO::PARAM_STR);
$select->execute();
while($ligne2=$select->fetch()){?>

    <div class="card" style="width: 18rem;">
    <img src="../boutique/admin/imgs/<?php echo $ligne2['PHOTO']; ?>" class="card-img-top" alt="Photo ">
    <div class="card-body">
    <?php  if(isset($_SESSION['intervenant_CESI'])){
        echo "<div id=\"signaler\">
        <button type=\"button\"  class=\"btn btn-outline-primary signaler\" id=\"signaler".$ligne2['PHOTO']."\">Signaler</button>
        
        </div>";
    }
}
}
?>
 <footer>
        <!--pied de page-->
    </footer>
</body>
</html>
