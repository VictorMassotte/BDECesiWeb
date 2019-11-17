<?php 
session_start();
include('../bdd.php'); 

if(isset($_SESSION['membre_BDE'])){
    
}elseif((isset($_SESSION['etudiant'])) || (isset($_SESSION['intervenant_CESI']))){
    header('Location: http://localhost/BDECesiWeb/BDESite/Module_Connexion_Inscription/Accueil.php');

}else{
    header('Location: ../Module_Connexion_Inscription/Connexion.php');
}

?>

<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/jumbotron/">
    <script src="../js/jquery-3.4.1.min.js"></script>
    <link href="../style/boutique.css" rel="stylesheet">
    <title>Menu Admin Boutique</title>
</head>
<?php include('../../elements/menu.php'); ?>
<div class="jumbotron">
       <h1 class="display-4">Visuel des categories de la boutique</h1>
</div>

<?php 

$select = $bdd->prepare('SELECT * FROM categorie');
$select->execute();

while($s=$select->fetch(PDO::FETCH_OBJ)){

    ?>

    <h5 class="text-center"><?php echo $s->nom; ?>
    <a class="btn btn-warning" href="?action=modify&amp;id=<?php echo $s->ID; ?>">Modifier</a>
    <a class="btn btn-danger" href="?action=delete&amp;id=<?php echo $s->ID; ?>">Supprimer</a><br><h5>



<?php
}

if(isset ($_GET['action'])){  
    
    if($_GET['action'] == "delete"){
        
        $id = $_GET['id'];
        $delete = $bdd->prepare("DELETE FROM categorie WHERE ID=:id");
        $delete->bindValue(':id', $id, PDO::PARAM_STR);
        $delete->execute();

        //header('Location: edit_deletecategorie.php');
    }
    
    if($_GET['action'] == 'modify'){

        $id = $_GET['id'];
        $select = $bdd->prepare("SELECT * FROM categorie WHERE ID=:id");
        $select->bindValue(':id', $id, PDO::PARAM_STR);
        $select->execute();

        $data = $select->fetch(PDO::FETCH_OBJ);

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

           // header("Refresh: 0;url=http://localhost/BDECesiWeb/BDESite/boutique/admin/edit_deletecategorie.php");
            

        } ?>

        <form method="post" action="">
        <div class="form-group text-center">
            <label for="exampleInput">Nom de l'article à modifier : </label>
            <input value="<?php echo $data->nom; ?>" type="text" class="form-control" name="nom" id="exampleFormControlInput1" placeholder="Le nom de l'article"><br>
            <button type="submit" name="submit" class="btn btn-primary mb-2">Modifier la categorie</button>
        </div>
        </form>

        <div class="text-center">
            <a href="edit_deletecategorie.php" class="btn btn-primary ">Actualiser la page</a>
        </div><br><br>

        
    <?php
        
    } 
}

require_once('../../elements/footer.php');

?>
</html>


