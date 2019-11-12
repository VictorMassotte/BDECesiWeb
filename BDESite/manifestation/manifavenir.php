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
            
            $nom=$reponse['NOM'];
            
            $desc=$reponse['DESCRIPTION'];
            
            $prix=$reponse['PRIX'];
            
            $urlimg=$reponse['IMAGE'];
            
            echo "
            <div class=\"card text-center text-white bg-dark\">
            <div class=\"card-header\">
            $nom
            </div>
            <div class=\"card-body\">
            <img src\"$urlimg\" class=\"card-img-top\" alt=\"Image de la manifestation\">
            <h5 class=\"card-title\"> Le $dateAffichable</h5>
            <p class=\"card-text\">$desc</p>
            <a href=\"#\" class=\"btn btn-primary\">Je m'inscrit</a>
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

