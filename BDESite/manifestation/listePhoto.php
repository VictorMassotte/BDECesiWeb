
<?php 
session_start();
if(isset($_SESSION['login'])){
    include('../boutique/bdd.php');
}else{
    header('Location: ../Module_Connexion_Inscription/Connexion.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="../css/jquery.dataTables.css" type="text/css" rel="stylesheet" media="screen">
<script src="../js/jquery-3.4.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

  
<script type="text/javascript" charset="utf8" src="../js/jquery.dataTables.js"></script>
 
        <script type="text/javascript" src="../js/signalerPhoto.js"></script>
        <script type="text/javascript" src="../js/likePhoto.js"></script>
        <script type="text/javascript" src="../js/signalerCommentairePhoto.js"></script>
        <link rel="stylesheet" href="../css/listePhoto.css">
      
        <title>Liste</title>
        <script type="text/javascript" charset="utf_8">
$(document).ready(function(){
$('.tabd').dataTable();
})
</script>        

</head>
<body>
    <header>
        
        <?php  require_once("../elements/menu.php"); ?>
    </header>
    <?php
$identifiant;
$id = array();
$user = $_SESSION['user_id'];
if(isset($_GET['submit'])){
$nom = $_GET['manif'];
$select = $bdd->prepare('SELECT * FROM ajouter_photo INNER JOIN manifestations ON manifestations.ID=ajouter_photo.ID WHERE NOM=:im');
$select->bindValue(':im', $nom, PDO::PARAM_STR);
$select->execute();
while($ligne2=$select->fetch()){
    $identifiant = $ligne2['ID_PHOTO'];
    $rqtSpe = $bdd->prepare('SELECT * FROM likerphoto WHERE ID_USERS=:idU AND ID=:idM');
            $rqtSpe->bindValue(':idU',$user, PDO::PARAM_STR);
            $rqtSpe->bindValue(':idM',$identifiant, PDO::PARAM_STR);
            $rqtSpe->execute();
            $row = $rqtSpe->fetch();
            if($row){  
                //l'utilisateur à deja liké, on ne fait rien ou on suggère de dislike
                $message = "Aimé"; 
            }
            else{
                //on envoie la requête dans la bdd
                $message = "J'aime";
            }
            
            $rqtSpe->closeCursor();
    
    
    echo "<div class=\"card text-center text-dark bg-light marge\">";
        if(isset($_SESSION['intervenant_CESI'])){
        echo "<div id=\"signalerPhoto\">
        <button type=\"button\"  class=\"btn btn-outline-secondary signalerPhoto\" id=\"signalerPhoto".$ligne2['PHOTO']."\">Signaler</button>
        
        </div>";
    }
    echo "<div class=\"card-body\" style=\"width: 25rem; margin-left: auto;
  margin-right: auto;\">
    <img src=\"../boutique/admin/imgs/".$ligne2['PHOTO']."\" class=\"card-img-top\" alt=\"Photo \">
    </div>";
    
    echo "<div id=\"bouton\">
    <input type=\"button\"   class=\"btn btn-outline-primary like".$identifiant."\" id=\"like".$identifiant."\" value=\"".$message."\">
    
    </div>
    
    ";
   echo "<div class=\"card-footer\">
   </div>";
   
   $rqtcom =$bdd->prepare('SELECT * FROM commenterPhoto WHERE id=:id  ');
   
   $rqtcom->bindValue(':id',$identifiant, PDO::PARAM_STR);
   $rqtcom->execute();
  echo " <div>
   <table class=\"tabd\"  class=\"display\" cellspacing=\"0\" width=\"100%\" >
   <thead>
   <tr>
   <th>Commentaire</th>
   <th>Signaler</th>
   </tr>
   </thead>
   <tbody>";

while ($ligne2=$rqtcom->fetch()){
    $rqtUser =$bdd->prepare('SELECT * FROM users WHERE id=:id');
    
    $rqtUser->bindValue(':id',$ligne2['ID_USERS'], PDO::PARAM_STR);
    $rqtUser->execute();
    if ($ligne3=$rqtUser->fetch()){
        $commentaire = $ligne3['MAIL']." : ".$ligne2['CONTENU']." Le : ".$ligne2['DATEHEURE'];
        $id_com = $ligne2['ID_COMMENTAIRE'];
        
        $id_user = $ligne2['ID_USERS'];
        
       echo " <tr>
<td>$commentaire</td>
<td>";
if(isset($_SESSION['intervenant_CESI'])){
    echo "<div id=\"signaler\">
    <input type=\"button\"  class=\"btn btn-outline-primary signaler\" id=\"signaler".$id_com."\" value=\"S\">
    
    </div>";
}
}
echo "</td>

</tr> ";
        

}echo "
</tbody>
</table>
</div>";

echo "
<form method=\"post\">
<textarea name=\"contenu".$identifiant."\" cols=\"70\" rows=\"1\" placeholder=\"Entrez votre commentaire\"></textarea>
<input type=\"submit\" value=\"Envoyer\" name=\"com\"/>
</form>
";
echo "</div>";
$id[]=$identifiant;
   
}
}
foreach($id as $key=>$value){
    
    if (isset($_POST['com'])){
        
        if(!empty($_POST["contenu".$value])){
            
            $contenu=$_POST["contenu".$value];
           
            $identifiant=$value;
            
            $requete = $bdd->query("INSERT INTO `commenterphoto`(`ID`, `ID_USERS`, `CONTENU`) VALUES (".$identifiant.",".$user.",'".$contenu."')");
            
            $contenu ="";
          
            
        }
    }
}
require_once("../elements/footer.php");
?>
 
</body>
</html>