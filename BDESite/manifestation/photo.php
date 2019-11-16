<?php 
session_start();
if(isset($_SESSION['login'])){
    include('../boutique/bdd.php');
}else{
    header('Location: ../Module_Connexion_Inscription/Connexion.php');
}

echo "<h1>Liste des photos</h1>
<form method=\"get\"  action=\"listePhoto.php\" >
<h4>Manifestation</h4>
<select name=\"manif\" required>";
 $rqt = $bdd->query('SELECT DISTINCT manifestations.ID ,NOM,DATEE FROM manifestations INNER JOIN ajouter_photo ON manifestations.ID=ajouter_photo.ID ORDER BY DATEE desc ');
//on récupère les manifestations qui ont des photos
while ($ligne = $rqt->fetch()) { 
    echo "test" ;
    $nom_manif=$ligne['NOM'];
        echo "<option value=\"".$nom_manif."\">".$nom_manif."</option>";
}
echo "
</select> 

<input type=\"submit\" name=\"submit\"/>
</form>";
?>