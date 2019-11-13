<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../js/inscrit.js"></script>
        <link rel="stylesheet" href="css/fonction.css">
        <title>Evenements à venir</title>
</head>
<body>
    <header>
        <!--en tête-->
        <!--menu-->
    </header>
    <!--corps du site-->
<?php
$bdd = new PDO('mysql:host=localhost;dbname=projet_web;charset=utf8', 'root', '');
$response = $bdd->query('SELECT ID,DATEE FROM manifestations ORDER BY DATEE');
$message =""; 
while ($ligne = $response->fetch()) {
    echo"<br>";
    $dateactuelle = new DateTime('now');
    $datetime1 = new DateTime($ligne['DATEE']);
    $interval = $datetime1->diff($dateactuelle);
        if($interval->format('%R%a')<0){
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
            $user = 2;

            $rqtSpe = $bdd->prepare('SELECT * FROM inscrire WHERE ID_USERS=:idU AND ID=:idM');
            $rqtSpe->bindValue(':idU',$user, PDO::PARAM_STR);
            $rqtSpe->bindValue(':idM',$identifiant, PDO::PARAM_STR);
            $rqtSpe->execute();
            $ligne = $rqtSpe->fetch();
            if($ligne){  
                //l'utilisateur à deja liké, on ne fait rien ou on suggère de dislike
                $message = "Inscrit"; 
            }
            else{
                //on envoie la requête dans la bdd
                $message = "Je m'inscrit";
            }  
            
            
            $rqtSpe->closeCursor();

            echo "
            <div class=\"card text-center text-white bg-dark\">
            <div class=\"card-header\">
            $nom
            </div>
            <div class=\"card-body\">
            <img src\"$urlimg\" class=\"card-img-top\" alt=\"Image de la manifestation\">
            <h5 class=\"card-title\"> Le $dateAffichable</h5>
            <p class=\"card-text\">$desc</p>
            <button type=\"button\"  class=\"btn btn-outline-primary inscrit".$identifiant."\" id=\"inscrit".$identifiant."-".$nom."\">".$message."</button>
            </div>
            <div class=\"card-footer text-muted\">".$interval->format('Dans %a jours')."
            </div>
            </div>
            ";
            $rqt->closeCursor();
        }else{
            // ne rien faire
        }
    }
    $response->closeCursor();
?>
    <footer>
        <!--pied de page-->
    </footer>
</body>
</html>

