<?php
session_start();
if(isset($_SESSION['login'])){
    include('../boutique/bdd.php');
}else{
    header('Location: ../Module_Connexion_Inscription/Connexion.php');
}?>
<h1>Ajout d'une photo</h1>
    <form method="post" enctype="multipart/form-data" action="ajout.php" >
        <h4>Manifestation</h4>
    <select name="manif" required>
   <?php $rqt = $bdd->query('SELECT manifestations.ID AS ID,NOM,DATEE FROM manifestations INNER JOIN inscrire ON manifestations.ID=inscrire.ID ORDER BY DATEE desc ');
    
    while ($ligne = $rqt->fetch()) {
        
        
        
        $dateactuelle = new DateTime('now');
        $datetime1 = new DateTime($ligne['DATEE']);
        $interval = $datetime1->diff($dateactuelle);
        if($interval->format('%R%a')<0){
            // ne rien faire
        }else{
            $nom_manif=$ligne['NOM'];
        echo "<option value=\"".$nom_manif."\">".$nom_manif."</option>";
        }
    }?>
    
 </select> 
        <h4>Photo</h4><input type="file" name="img"/><br><br>
        <input type="submit" name="submit"/>
    </form>

<?php
   $user=$_SESSION['user_id'];
    
   //Gauthier Sannier
   $user_mail = $_SESSION['user_Mail'];
    if(isset($_POST['submit'])){
    //$photo = $_POST['img'];
    $nom = $_POST['manif'];
    $img = $_FILES['img']['name'];
    $img_tmp = $_FILES['img']['tmp_name'];
    if(!empty($img_tmp)){
        echo "test";        
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
            
            
           
            $rqtInsertion = $bdd->exec("CALL ajout_Photo('".$nom."', '".$user_mail."', '".$img."')");
   header('Location: manifpasse.php');
        }
        
    }else{
        echo 'Veuillez rentrer une image';
    }
    
   
    
    }

   
?>


