<?php 
if(!isset($_SESSION['flag'])) {
    session_start();
    $_SESSION['flag'] = true;
    }
    echo "<h1>Poster une manifestation</h1>";
    if(isset($_SESSION['membre_BDE'])){
        //fonction poster manifestation
        //génération d'un formulaire en method post qui permet d'entrer les valeurs de la manifestation à ajouter
           echo"
        <form method=\"post\" action=\"ajoutManifestation.php\">
            <label for=\"nom\">Nom de la manifestation</label><input type=\"text\" name=\"nom\"><br>
            <label for=\"descr\">Description</label><textarea name=\"descr\" rows=\"1\" cols=\"40\"></textarea><br>
            image<input type=\"text\" name=\"image\"><br>
            <label for=\"recurence\">Recurence</label>
            <select name=\"recurence\">
                <option value=\"quotidien\">Quotidien</option>
                <option value=\"hebdomadaire\">Hebdomadaire</option>
                <option value=\"mensuel\">Mensuel</option>
                <option value=\"annuel\">Annuel</option>
                <option value=\"sans\" selected=\"selected\">Sans</option>
            </select><br>
            <label for=\"instance\">Nombre d'instances</label>
            <select name=\"instance\">";
            $i=0;
            while($i<11){          
                echo "<option value=\"instance.$i\">$i</option>";
                $i=$i+1;
            }
            echo"
            </select><br>
            <label for=\"prix\">Prix</label><input type=\"text\" name=\"prix\"><br>";
            //partie génération des jours dans le formulaire en liste déroulante
            echo"<label for=\"jour\">Jour</label><select name=\"jour\">";
            $i=1;
            while($i<32){          
                echo "<option value=\"jour$i\">$i</option>";
                $i=$i+1;
            }
            echo "</select>";

            //génération des mois dans le formulaire en liste déroulante
            echo"<label for=\"mois\">Mois</label><select name=\"mois\">";
            echo"
            <option value=\"1\">Janvier</option>
            <option value=\"2\">Février</option>
            <option value=\"3\">Mars</option>
            <option value=\"4\">Avril</option>
            <option value=\"5\">Mai</option>
            <option value=\"6\">Juin</option>
            <option value=\"7\">Juillet</option>
            <option value=\"8\">Août</option>
            <option value=\"9\">Septembre</option>
            <option value=\"10\">Octobre</option>
            <option value=\"11\">Novembre</option>
            <option value=\"12\">Décembre</option>
            ";
            echo "</select>";

            //génération des années dans le formulaire année
            echo"<label for=\"annee\">Année</label><select name=\"annee\">";
            $i=2019;
            while($i<2101){          
                echo "<option value=\"annee$i\">$i</option>";
                $i=$i+1;
            }
            echo "</select>";
            
            echo"
            <input type=\"submit\" name=\"Envoyer\"><br>
            <form/><br>";
                //traitement du formulaire
                if(!empty($_POST['nom']) && !empty($_POST['descr']) && !empty($_POST['recurence']) && !empty($_POST['instance']) && !empty($_POST['prix'])&& !empty($_POST['jour']) && !empty($_POST['mois']) && !empty($_POST['annee'])){
                    //le formulaire a des valeurs et n'a aucun champ vide
                    echo "we are in";
                    //nous allons concatener les différents _POST relatif à la date pour obtenir une date
                    $jour=str_replace("jour","",$_POST['jour']);
                    $mois=$_POST['mois'];
                    $annee=str_replace("annee","",$_POST['annee']);
                    $dateChoisie=$annee."-".$mois."-".$jour;
                    echo $dateChoisie;

                    //vérification des champs

                    //on vérifie que cette manifestation n'existe pas déja
                    include('../boutique/bdd.php');
                    $testExistance = $bdd->prepare("SELECT * FROM manifestations WHERE NOM=:nom AND DATEE=:datee AND RECURRENCE=:recurence AND PRIX=:prix");
                    $testExistance->bindValue(':nom',$_POST['nom'], PDO::PARAM_STR);
                    $testExistance->bindValue(':recurence',$_POST['recurence'], PDO::PARAM_STR);
                    $testExistance->bindValue(':prix',$_POST['prix'], PDO::PARAM_STR);
                    $testExistance->bindValue(':datee',$dateChoisie,PDO::PARAM_STR);
                    $testExistance->execute();
                    //$testExistance->execute();
                    $existance= $testExistance->fetch();
                    if($existance!=NULL){
                        //la variable existe, l'objet existe déjà
                        echo"la manifestation existe déjà";
                    }else{
                        //la variable n'exixste pas : on peut poursuivre vers la préparation de la requête
                        echo"cette manifestation n'existe pas";
                        //on va préparer une requête SQL avec ces données, il faut que la requête soit exécutée autant de fois que la valeur de l'instance et que la date par rapport au moment de l'envoi soit incrémenté de la valeur de la récurence
                    }
                }else{
                    //erreur
                        echo"Veuillez remplir tous les champs s'il vous plait";
                }
            








    }else{
    header('Location: ../Module_Connexion_Inscription/Connexion.php');
 }
?>
<!--c'est ici que seront affichés les résultats de nos reqêtes-->
<br>
Ajout d'une partie pour la visualisation des résulats de requête