<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<h1>Modifier ou supprimer une categorie</h1>

<?php 
include('verif.php'); 
include('../bdd.php');

$select = $bdd->prepare('SELECT * FROM categorie');
$select->execute();

while($s=$select->fetch(PDO::FETCH_OBJ)){

    echo $s->nom;
    ?>

    <a href="?action=modify&amp;id=<?php echo $s->ID; ?>">Modifier</a>
    <a href="?action=delete&amp;id=<?php echo $s->ID; ?>">Supprimer</a><br>

<?php
}

if(isset ($_GET['action'])){  
    
    if($_GET['action'] == "delete"){
        
        $id = $_GET['id'];
        $delete = $bdd->prepare("DELETE FROM categorie WHERE ID=:id");
        $delete->bindValue(':id', $id, PDO::PARAM_STR);
        $delete->execute();

        header('Location: edit_deletecategorie.php');
    }
    
    if($_GET['action'] == 'modify'){

        $id = $_GET['id'];
        $select = $bdd->prepare("SELECT * FROM categorie WHERE ID=:id");
        $select->bindValue(':id', $id, PDO::PARAM_STR);
        $select->execute();

        $data = $select->fetch(PDO::FETCH_OBJ);
        
    }?>

    <form method="post" action="">
        <br><h4>Nom de l'article à modifier :</h4><input value="<?php echo $data->nom; ?>" type="text" name="nom"/><br><br>
        <input type="submit" name="submit" value="Modifier"/>
    </form>


<?php

if(isset($_POST['submit'])){
       
    $nom = $_POST['nom']; 

    $select = $bdd->prepare("SELECT nom FROM categorie WHERE ID=:id");
    $select->bindValue(':id', $id, PDO::PARAM_STR);
    $select->execute();

    $result = $select->fetch(PDO::FETCH_OBJ);

    $update = $bdd->prepare("UPDATE categorie SET nom=:nom WHERE ID=:id");
    $update->bindValue(':nom', $nom, PDO::PARAM_STR);
    $update->bindValue(':id', $id, PDO::PARAM_STR);
    $update->execute();

    $id = $_GET['id'];

    $update = $bdd->prepare("UPDATE produits SET CATEGORIE=:nom WHERE CATEGORIE=:categorie");
    $update->bindValue(':nom', $nom, PDO::PARAM_STR);
    $update->bindValue(':categorie', $result->nom, PDO::PARAM_STR);
    $update->execute();

    header('Location: edit_deletecategorie.php');
    
}

}

?>


