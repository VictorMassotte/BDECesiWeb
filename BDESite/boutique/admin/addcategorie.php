<?php
session_start();
require_once('../../elements/menu.php'); 
include('../bdd.php');

if(isset($_SESSION['membre_BDE'])){
    
}elseif((isset($_SESSION['etudiant'])) && (isset($_SESSION['intervenant']))){
    header('Location: ../index.php');

}else{
    header('Location: http://localhost/BDECesiWeb/BDESite/Module_Connexion_Inscription/Connexion.php');
}

?>


<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<h1>Ajouter une categorie</h1>

    <form method="post" action="">
        <h4>Nom de la categorie :</h4><input type="text" name="nom"/><br><br>
        <input type="submit" name="submit" value="Ajouter"/>
    </form>


<?php



if(isset($_POST['submit'])){
    
    $nom = $_POST['nom'];

    if($nom){

        $insert = $bdd->prepare("INSERT INTO `categorie` (`nom`) VALUES (:nom)");
        $insert->bindValue(':nom', $nom, PDO::PARAM_STR);
        $insert->execute();

                    
        echo "Vous avez bien enregistrer une nouvelle categorie";
        $insert->closeCursor();

    }else{
        echo 'Veuillez remplir le champs !';
    }       
        
    }
?>
