<?php
session_start();
if(isset($_SESSION['membre_BDE'])){
    include('../boutique/bdd.php');
}else{
    header('Location: ../Module_Connexion_Inscription/Connexion.php');
}?>
<h1>Suppresion d'un commentaire de photo</h1>
    <form method="post" enctype="multipart/form-data" action="" >
        <h4>Commentaire</h4>
        <input type="number" name="id"/>
        
        <input type="submit" name="submit"/>
    </form>

<?php
   
    if(isset($_POST['submit'])){
    $id = $_POST['id'];

    $select = $bdd->query("SELECT * FROM `commenterphoto` WHERE ID_COMMENTAIRE='".$id."'");
    if($ligne=$select->fetch()){
    $rqtDelete = $bdd->query("DELETE FROM `commenterphoto` WHERE ID_COMMENTAIRE='".$id."'");
   // $rqtDelete->bindValue(':photo',$photo, PDO::PARAM_STR);
    //$rqtDelete->execute();
    $rqtDelete->closeCursor();
    header('Location: admin.php');
    }else{
        //header('Location:supprimer.php');
        echo "renseignez un id valide";
    }
    
    }
    

   
?>


