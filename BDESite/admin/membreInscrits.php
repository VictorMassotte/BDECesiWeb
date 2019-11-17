<?php
session_start();
require_once('../boutique/bdd.php');

if(isset($_SESSION['membre_BDE'])){
    
}elseif((isset($_SESSION['etudiant'])) || (isset($_SESSION['intervenant_CESI']))){
    header('Location: http://localhost/BDECesiWeb/BDESite/Module_Connexion_Inscription/Accueil.php');

}else{
    header('Location: http://localhost/BDECesiWeb/BDESite/Module_Connexion_Inscription/Connexion.php');
}

?>
<?php
    if(isset($_POST['envoyer'])&&isset($_POST['manif'])){
        $info = array();
        $fichier_csv = fopen('inscrit.csv', 'w+');
        $choixManif=$_POST['manif'];
        $rqtListe = $bdd->prepare('SELECT users.NOM,PRENOM,MAIL,LOCALISATION FROM inscrire,manifestations,users WHERE manifestations.ID = inscrire.ID AND users.ID = inscrire.ID_USERS AND manifestations.ID=:id; ');
        $rqtListe->bindValue(':id',$choixManif, PDO::PARAM_STR);
        $rqtListe->execute();
        //on crée la ligne d'en-tête
        $entete =array("nom","prenom","mail","localisation");
        //crétion du contenu du tableau    
        $contenu=array();
            $i=-1;
            while($user=$rqtListe->fetch()){
                $nom=$user['NOM'];
                $prenom=$user['PRENOM'];
                $mail=$user['MAIL'];
                $localisation=$user['LOCALISATION'];
                //ajout du contenu au tableau
                $contenu[]=array($nom,$prenom,$mail,$localisation);
                //echo $nom." ".$prenom." ".$mail." ".$localisation;
                $info[] = $nom." ".$prenom." ".$mail." ".$localisation;
                
                $i=$i+1;
            }
        if($i==-1){
            echo "il n'y a pas d'incrits";
        }
        echo "<br> fin de liste";
        fputcsv($fichier_csv, $info, ';');
        $rqtListe->closeCursor();
        header('Location: inscrit.csv');
    }
?>      
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/jumbotron/">
    <link href="jumbotron.css" rel="stylesheet">
    <link href="../style/boutique.css" rel="stylesheet">
    <title>Menu Admin Manifestation</title>
</head>
<?php include('../elements/menu.php'); ?>
<div class="jumbotron">
       <h1 class="display-4">Choix de la manifestation</h1>
    </div>

<section class="text-center col-md-6 mb-3">
<form method="post" enctype="multipart/form-data">
        <label for="exampleFormControlSelect1">Manifestation : </label>
        <select class="form-control" name="manif" id="exampleFormControlSelect1">
    <!--on récupère sous forme d'une liste déroulante l'ensemble des manifestations à venir-->
    <?php
        $listeManif = $bdd->query("SELECT * FROM manifestations");
        while($ligne = $listeManif->fetch()){
            $dateactuelle = new DateTime('now');
            $datetime1 = new DateTime($ligne['DATEE']);
            $interval = $datetime1->diff($dateactuelle);
            if($interval->format('%R%a')<0){
                //l'évenement est à venir
                echo $ligne['NOM']."<br>";
                ?>
                <option value=" <?php echo $ligne['ID']; ?> "> <?php echo $ligne['NOM']; ?> </option>
                <?php
            }  
        }
    ?>

        </select>
        <br>
        <input type="submit" name="envoyer" class="btn btn-primary mb-2">   
</form>
</section>
<footer>
   <?php include_once('../elements/footer.php');?>
</footer>
</html>

