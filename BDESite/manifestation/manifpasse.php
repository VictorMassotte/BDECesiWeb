<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="css/fonction.css">
        <title>Evenements passés</title>
</head>
<body>
    <header>
        <!--en tête-->
        <!--menu-->
    </header>
    <!--corps du site-->
<?php
$bdd = new PDO('mysql:host=localhost;dbname=projet_web;charset=utf8', 'root', '');
$response = $bdd->query('SELECT ID,DATEE FROM manifestations ORDER BY DATEE desc');

$id = array();
$nom;
$manif_Nom= array();
$identifiant;
$user_Nom;
$user_Prenom;
while ($ligne = $response->fetch()) {
    echo"<br>";
    $dateactuelle = new DateTime('now');
    $datetime1 = new DateTime($ligne['DATEE']);
    $interval = $datetime1->diff($dateactuelle);
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

                
            //nous allons réaliser la partie envoi de commentaires
            
            //partie affichage
            echo "
            <div class=\"card text-center text-white bg-dark\">
            <div class=\"card-header\">
            $nom
            </div>
            <div class=\"card-body\">
            <img src\"$urlimg\" class=\"card-img-top\" alt=\"Image de la manifestation\">
            <h5 class=\"card-title\"> Le $dateAffichable</h5>
            <p class=\"card-text\">$desc</p>
            <p class=\"card-text text-muted\">".$interval->format('il y a %a jours')."<p>
            </div>
            <div>
            <form method=\"post\">
            <button type=\"button\" name=\"like".$identifiant."\" class=\"btn btn-outline-primary\" id=\"like\">J'aime</button>
            </form>
            </div>

            <div class=\"card-footer\">
            </div>";
            //nous allons faire la partie affichage des commentaires
                //récupération des commentaires
            $rqtcom =$bdd->prepare('SELECT * FROM commenter WHERE id=:id');
            $rqtcom->bindValue(':id',$ligne['ID'], PDO::PARAM_STR);
            $rqtcom->execute();
            while($ligne2=$rqtcom->fetch()){
                $rqtNom=$bdd->prepare('SELECT * FROM users WHERE id=:idu');
                $rqtNom->bindValue(':idu',$ligne2['ID_USERS'],PDO::PARAM_STR);
                $rqtNom->execute();
                $nomUser=$rqtNom->fetch();
                $commentaire = $nomUser['MAIL']." : ".$ligne2['CONTENU']." Le : ".$ligne2['DATEHEURE'];
                $user_Nom = $nomUser['NOM'];
                $user_Prenom = $nomUser['PRENOM'];
                echo $commentaire."<br>";
            }
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
        
        
        
        
        /*if(isset($identifiant) AND isset($nom) AND !empty($contenu) AND !empty($identifiant) AND !empty($nom)){
            $com=htmlspecialchars($contenu);
            echo $com.$identifiant;
        }*/
    }
    foreach($id as $key=>$value){
       //echo $key.$value;
        if(!empty($_POST["contenu".$value])){
            //echo $key.$value;
            $contenu=$_POST["contenu".$value];
            
           // echo $contenu.$value.$key;
            $identifiant=$value;
            
            $requete = $bdd->exec("CALL commentaire('".$manif_Nom[$key]."', '".$user_Nom."', '".$user_Prenom."', '".$contenu."')");
            $contenu ="";
        }
    }
    foreach($id as $key=>$value){
        //echo $key.$value;
         if(!empty($_POST["like".$value])){
             //echo $key.$value;
             $like=$_POST["like".$value];
             echo $like;
            // echo $contenu.$value.$key;
             $identifiant=$value;
            
         }
     }
     
    $rqt->closeCursor();
    $response->closeCursor();
?>
    <footer>
        <!--pied de page-->
    </footer>
</body>
</html>

