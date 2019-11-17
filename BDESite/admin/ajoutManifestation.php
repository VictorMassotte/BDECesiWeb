<?php 
session_start();
if(isset($_SESSION['login'])){
    include('../boutique/bdd.php');
}else{
    header('Location: ../Module_Connexion_Inscription/Connexion.php');
}
   
    echo "<h1>Poster une manifestation</h1>";
    if(isset($_SESSION['membre_BDE'])){
        //fonction poster manifestation
        //génération d'un formulaire en method post qui permet d'entrer les valeurs de la manifestation à ajouter
           echo"
           a
        <form method=\"post\" action=\"ajoutManifestation.php\" enctype=\"multipart/form-data\">
            <label for=\"nom\">Nom de la manifestation</label><input type=\"text\" name=\"nom\"><br>
            <label for=\"descr\">Description</label><textarea name=\"descr\" rows=\"1\" cols=\"40\"></textarea><br>
            image<input type=\"file\" name=\"image\"><br>
            <label for=\"recurrence\">Recurence</label>
            <select name=\"recurrence\">
                <option value=\"Récurrente\">Récurrente</option>
                <option value=\"Ponctuelle\">Ponctuelle</option>
                
            </select><br>";
            
            echo"
            
            <label for=\"prix\">Prix</label><input type=\"number\" name=\"prix\"><br>";
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
                if (isset($_POST['Envoyer'])){
                    if(isset($_POST['nom']) && isset($_POST['descr']) && isset($_POST['recurrence'])  && isset($_POST['prix'])&& isset($_POST['jour']) && isset($_POST['mois']) && isset($_POST['annee'])){
                        //le formulaire a des valeurs et n'a aucun champ vide
                        //nous allons concatener les différents _POST relatif à la date pour obtenir une date
                       
                        $jour=str_replace("jour","",$_POST['jour']);
                        $mois=$_POST['mois'];
                        $annee=str_replace("annee","",$_POST['annee']);
                        $dateChoisie=$annee."-".$mois."-".$jour;
                        $nom = $_POST['nom'];
                        $desc = $_POST['descr'];
                        $rec = $_POST['recurrence'];
                        $prix = $_POST['prix'];
                        
                        //vérification des champs
                        
                        //on vérifie que cette manifestation n'existe pas déja
                       
                        $testExistance = $bdd->prepare("SELECT * FROM manifestations WHERE NOM=:nom AND DATEE=:datee AND RECURRENCE=:recurence AND PRIX=:prix");
                        $testExistance->bindValue(':nom',$_POST['nom'], PDO::PARAM_STR);
                        $testExistance->bindValue(':recurence',$_POST['recurrence'], PDO::PARAM_STR);
                        $testExistance->bindValue(':prix',$_POST['prix'], PDO::PARAM_STR);
                        $testExistance->bindValue(':datee',$dateChoisie,PDO::PARAM_STR);
                        $testExistance->execute();
                        //$testExistance->execute();
                        $existance= $testExistance->fetch();
                        if($existance!=NULL){
                            //la variable existe, l'objet existe déjà
                            echo"la manifestation existe déjà";
                        }else{
                            $img = $_FILES['image']['name'];
                            $img_tmp = $_FILES['image']['tmp_name'];
                            if(!empty($img_tmp)){
                                
                                $image = explode('.', $img);
                                
                                $image_ext = end($image);
                                if(in_array(strtolower($image_ext), array('png', 'jpg', 'jpeg')) == false){
                                    echo 'Veuillez rentrer une image en .png ou .jpg ou .jpeg';
                                    
                                }else{
                                    
                                    $image_size = getimagesize($img_tmp);
                                    
                                    if($image_size['mime'] == 'image/jpeg'){
                                        $image_src = imagecreatefromjpeg($img_tmp);
                                    }else if($image_size['mime'] == 'image/png'){
                                        $image_src = imagecreatefrompng($img_tmp);
                                    }else{
                                        
                                        $image_src = false;
                                        echo 'Veuillez rentrer une image valide !';
                                        
                                    }
                                    $image_finale = $image_src;
                                    imagejpeg($image_finale,'../boutique/admin/imgs/'.$img);
                                    
                                    
                                    
                                    $rqtInsertion = $bdd->prepare("INSERT INTO `manifestations`(`NOM`, `DESCRIPTION`, `IMAGE`, `DATEE`, `RECURRENCE`, `PRIX`) VALUES (:nom, :desc,:img,:date, :rec,:prix)");
                                    $rqtInsertion->bindValue(':nom',$nom, PDO::PARAM_STR);
                                    $rqtInsertion->bindValue(':desc',$desc, PDO::PARAM_STR);
                                    $rqtInsertion->bindValue(':img',$img, PDO::PARAM_STR);
                                    $rqtInsertion->bindValue(':date',$dateChoisie, PDO::PARAM_STR);
                                    $rqtInsertion->bindValue(':rec',$rec, PDO::PARAM_STR);
                                    $rqtInsertion->bindValue(':prix',$prix, PDO::PARAM_STR);
                                    $rqtInsertion->execute();
                                    $rqtInsertion->closeCursor();
                                }
                                
                            }else{
                                echo 'Veuillez rentrer une image';
                            }
                            //la variable n'exixste pas : on peut poursuivre vers la préparation de la requête
                            echo"cette manifestation n'existe pas";
                            //on va préparer une requête SQL avec ces données, il faut que la requête soit exécutée autant de fois que la valeur de l'instance et que la date par rapport au moment de l'envoi soit incrémenté de la valeur de la récurence
                        }
                    }else{
                        //erreur
                        echo"remplir touss les champs";
                        
                    }
                    
                }







    }else{
    header('Location: ../Module_Connexion_Inscription/Connexion.php');
 }
?>
<!--c'est ici que seront affichés les résultats de nos reqêtes-->
<br>
