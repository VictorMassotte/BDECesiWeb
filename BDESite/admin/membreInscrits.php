<?php
session_start();
echo "<h1> Lister les membres inscrits pour une manifestation</h1>";
?>
<form method="post" action="membreInscrits.php">
    <select name="manif">
    <?php include("../boutique/bdd.php");?>
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
    <input type="submit" name="envoyer">    
</form>

<?php
    if(isset($_POST['envoyer'])&&isset($_POST['manif'])){
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
                echo $nom." ".$prenom." ".$mail." ".$localisation;
                $i=$i+1;
            }
        if($i==-1){
            echo "il n'y a pas d'incrits";
        }else{
           echo "<br> fin de liste";
        }
        
        $rqtListe->closeCursor();
    }
?>      