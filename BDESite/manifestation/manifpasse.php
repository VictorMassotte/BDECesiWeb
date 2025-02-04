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
 

        <script type="text/javascript" src="../js/like.js"></script>
       
        <script type="text/javascript" src="../js/signalerManif.js"></script>
        <script type="text/javascript" src="../js/signaler.js"></script>
      
        <link rel="stylesheet" href="../css/manifpasse.css">
        <title>Evenements passés</title>
        
        <script type="text/javascript" charset="utf_8">
$(document).ready(function(){
$('.tabd').dataTable();
})
</script>        
</head>
<body>
    <header>
        <!--en tête-->
        <!--menu-->
        <?php  require_once("../elements/menu.php"); ?>
    </header>
    <!--corps du site-->
   
<?php
$response = $bdd->query('SELECT ID,DATEE FROM manifestations ORDER BY DATEE desc');
$id = array();
$nom;
$manif_Nom= array();
$identifiant;
$user_Nom = $_SESSION['user_Nom'];
$user_Prenom = $_SESSION['user_Prenom'];;
$user_Mail=$_SESSION['user_Mail'];;
$message ="";
$messagelike = "";
echo "
 <div id=\"ajout\" class=\"flex\">
    <button type=\"button\"  class=\"btn btn-outline-secondary ajout\" id=\"ajout\" ><a href=\"ajout.php\">Poster une photo</a></button>
    
    </div>";
if (isset($_SESSION['intervenant_CESI'])){
    echo "<div id=\"télécharger\" class=\"flex\">
    <button type=\"button\"  class=\"btn btn-outline-secondary télécharger\" id=\"télécharger\" ><a href=\"télécharger.php\">Télécharger les photos</a></button>
    
    </div>";
}
while ($ligne = $response->fetch()) {
    
   
    $dateactuelle = new DateTime('now');
    $datetime1 = new DateTime($ligne['DATEE']);
    $interval = $datetime1->diff($dateactuelle);
    //on fait une condition pour savoir s'il s'agit d'une manifestation passé ou à venir
        if($interval->format('%R%a')<0){
            // ne rien faire
        }else{
            
            $rqt = $bdd->prepare('SELECT * FROM manifestations WHERE ID=:id');
            $rqt->bindValue(':id',$ligne['ID'], PDO::PARAM_STR);
            $rqt->execute();
            //mise en place de l'evenement dans la page
            $reponse=$rqt->fetch();
        
            $datebrut=explode("-",$reponse['DATEE']);
            $datey=$datebrut[0];
            $datem=$datebrut[1];
            $datej=$datebrut[2];
            $dateAffichable=$datej."/".$datem."/".$datey;
        
            $identifiant=$reponse['ID'];
            
            $nom=$reponse['NOM'];
            
            $desc=$reponse['DESCRIPTION'];
            
            $prix=$reponse['PRIX'];
            
            $urlimg=$reponse['IMAGE'];
            $user = $_SESSION['user_id'];
            $rqtSpe = $bdd->prepare('SELECT * FROM liker WHERE ID_USERS=:idU AND ID=:idM');
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
            //partie comptage de likes
            $rqtNbLike = $bdd->prepare('SELECT COUNT(ID_USERS) AS NBLIKE FROM liker WHERE ID=:idM');
            $rqtNbLike->bindValue(':idM',$identifiant, PDO::PARAM_STR);
            $rqtNbLike->execute();
            $ligneLike = $rqtNbLike->fetch();
            $nblike = $ligneLike['NBLIKE'];
            if($ligneLike['NBLIKE']){
                if($nblike>=1){
                    $messagelike=$nblike." personne aime la manifestation";
                }else{
                    $messagelike=$nblike." personnes aiment la publication";
                }
            }
            
                
            //nous allons réaliser la partie envoi de commentaires
            
            //partie affichage
            echo "
            <div class=\"card text-center bg-light marge\">
            <div class=\"card-header\" id=\"nom\">
            $nom";
           if(isset($_SESSION['intervenant_CESI'])){
                echo "<div id=\"signalerManif\">
                <button type=\"button\"  class=\"btn btn-outline-secondary signalerManif\" id=\"signalerManif".$identifiant."\">Signaler</button>
                
                </div>";
            }
            echo "</div>
            <div class=\"card-body\" style=\"width: 25rem; margin-left: auto;
            margin-right: auto;\">
            <img src=\"../boutique/admin/imgs/".$urlimg."\" class=\"card-img-top\" alt=\"Image de la manifestation\">
            <h5 class=\"card-title\"> Le $dateAffichable</h5>
            <p class=\"card-text\">$desc</p>
            <p class=\"card-text text-muted\">".$interval->format('il y a %a jours')."<p>
            </div>";
            
            echo "<div id=\"bouton\">
            <button type=\"button\"  class=\"btn btn-outline-primary like".$identifiant."\" id=\"like".$identifiant."-".$nom."\">".$message."</button>
            <p>".$messagelike."</p>
            </div>";
            
          
            //nous allons faire la partie affichage des commentaires
                //récupération des commentaires
            
            $rqtcom =$bdd->prepare('SELECT * FROM commenter WHERE id=:id ');
            
            $rqtcom->bindValue(':id',$ligne['ID'], PDO::PARAM_STR);
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
            echo"
            </div>
            ";
            $id[]=$identifiant;
            $manif_Nom[] = $nom;
            

        }
        
        
        
        
     
    }
   
    foreach($id as $key=>$value){
       
       if (isset($_POST['com'])){
        if(!empty($_POST["contenu".$value])){
            
            $contenu=$_POST["contenu".$value];
            
            $identifiant=$value;
            //on appelle une procédure stockée pour remplir la table commenter
            $requete = $bdd->exec("CALL commentaire('".$manif_Nom[$key]."', '".$user_Mail."', '".$contenu."')");
            $contenu ="";
            
        }
    }
    }
    
     
    $rqt->closeCursor();
    $response->closeCursor();
    
    require_once("../elements/footer.php");
 ?>
       
    
</body>
</html>