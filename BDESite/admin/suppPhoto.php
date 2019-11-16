<?php
session_start();
if(isset($_SESSION['membre_BDE'])){
    include('../boutique/bdd.php');
}else{
    header('Location: ../Module_Connexion_Inscription/Connexion.php');
}?>
<h1>Suppresion d'une photo</h1>
    <form method="post" enctype="multipart/form-data" action="suppPhoto.php" >
        <h4>Manifestation</h4>
    <select name="image" required>
   <?php $rqt = $bdd->query('SELECT PHOTO FROM ajouter_photo ');
    
    while ($ligne = $rqt->fetch()) {
         $photo=$ligne['PHOTO'];
        echo "<option value=\"".$photo."\">".$photo."</option>";
    }
    $rqt->closeCursor();
    ?>
    
 </select> 
        
        <input type="submit" name="submit"/>
    </form>

<?php
   
    if(isset($_POST['submit'])){
    $photo = $_POST['image'];
    echo $photo;
    $rqtDelete = $bdd->query("DELETE FROM `ajouter_photo` WHERE PHOTO='".$photo."'");
   // $rqtDelete->bindValue(':photo',$photo, PDO::PARAM_STR);
    //$rqtDelete->execute();
    $rqtDelete->closeCursor();
    header('Location: admin.php');
    
    }
    

   
?>


