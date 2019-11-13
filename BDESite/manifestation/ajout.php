<?php
session_start();
if(isset($_SESSION['login'])){

}else{
    header('Location: ../Module_Connexion_Inscription/Connexion.php');
}
echo "<h1>Ajout d'un produit</h1>
    <form method=\"post\" >
        <h4>Manifestation</h4>
    <select name=\"manif\" required>
    <option value=\"Vente de crêpes\">Vente de crêpes</option>
    <option value=\"Concert\">Concert</option>
    <option value=\"Soirée au PAV\">Soirée au PAV</option>
  </select> 
        <h4>Photo</h4><input type=\"file\" name=\"img\"/><br><br>
        <input type=\"submit\" name=\"submit\"/>
    </form>";

include('../boutique/bdd.php');
    $user=2;//Gauthier Sannier
    $user_mail = "gauthiersannier@viacesi.fr";
    if(isset($_POST['submit'])){
    $photo = $_POST['img'];
    $nom = $_POST['manif'];
    echo $nom." ".$user_mail." ".$photo;
    $rqtInsertion = $bdd->exec("CALL ajout_Photo('".$nom."', '".$user_mail."', '".$photo."')");
    header('Location: manifpasse.php');
    }

   
?>


