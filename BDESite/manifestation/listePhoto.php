
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
       
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
 
        <script type="text/javascript" src="../js/signalerPhoto.js"></script>
        <script type="text/javascript" src="../js/likePhoto.js"></script>
        
        <link rel="stylesheet" href="css/fonction.css">
        <title>Liste</title>
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
    
    ?>
    <div class="card text-center text-white bg-dark">
    <div class="card-body" style="width: 18rem; margin-left: auto;
  margin-right: auto;">
    <img src="../boutique/admin/imgs/<?php echo $ligne2['PHOTO']; ?>" class="card-img-top" alt="Photo ">
    </div>
    <?php  if(isset($_SESSION['intervenant_CESI'])){
        echo "<div id=\"signalerPhoto\">
        <button type=\"button\"  class=\"btn btn-outline-primary signalerPhoto\" id=\"signalerPhoto".$ligne2['PHOTO']."\">Signaler</button>
        
        </div>";
    }
    echo "<div id=\"bouton\">
    <button type=\"button\"  class=\"btn btn-outline-primary like".$identifiant."\" id=\"like".$identifiant."\">".$message."</button>
    
    </div>
    
    ";
   echo "<div class=\"card-footer\">
   </div>";
   
   $rqtcom =$bdd->prepare('SELECT * FROM commenterPhoto ORDER BY `commenterphoto`.`DATEHEURE` DESC LIMIT 5 WHERE id=:id');
   
   $rqtcom->bindValue(':id',$identifiant, PDO::PARAM_STR);
   $rqtcom->execute();
   
   while($ligne2=$rqtcom->fetch()){
    $rqtUser =$bdd->prepare('SELECT * FROM users WHERE id=:id');
    
    $rqtUser->bindValue(':id',$ligne2['ID_USERS'], PDO::PARAM_STR);
    $rqtUser->execute();
    if ($ligne3=$rqtUser->fetch()){
        $commentaire = $ligne3['MAIL']." : ".$ligne2['CONTENU']." Le : ".$ligne2['DATEHEURE'];
        $id_com = $ligne2['ID_COMMENTAIRE'];
        $id_user = $ligne2['ID_USERS'];
        
        echo $commentaire;
        echo "<br>";
        if(isset($_SESSION['intervenant_CESI'])){
            echo "<div id=\"signaler\">
            <button type=\"button\"  class=\"btn btn-outline-primary signaler\" id=\"signaler".$id_com."\">Signaler</button>
            
            </div>";
        }
    }
}
echo "
<form method=\"post\">
<textarea name=\"contenu".$identifiant."\" cols=\"70\" rows=\"1\" placeholder=\"Entrez votre commentaire\"></textarea>
<input type=\"submit\" value=\"Envoyer\" name=\"com\"/>
</form>
";
echo "</div><br>";
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
            header('Location: photo.php');
            
        }
    }
}
require_once("../elements/footer.php");
?>
 
</body>
</html>