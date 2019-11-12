<?php require_once('../../elements/menu.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/jumbotron/">
    <link href="jumbotron.css" rel="stylesheet">
    <link href="../style/boutique.css" rel="stylesheet">
    
    <title>Menu Admin Boutique</title>
</head>

<body>
    <div class="jumbotron">
        <br><br><br> <h1 class="display-4">Boutique BDE CESI</h1>
    </div>
    
    <main>
        
        <h1> Menu Admin Boutique</h1></div>
        <div>
        <p>
            <a class="btn btn-primary" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Les Articles</a>
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#multiCollapseExample2" aria-expanded="false" aria-controls="multiCollapseExample2">Les categories</button>
        </p>
        
        <div class="row">
            <div class="col">
                <div class="collapse multi-collapse" id="multiCollapseExample1">
                    <div class="card card-body">
                        <a href="AjoutArticle.php">Ajouter un article</a>
                        <a href="visu.php">Modifier / Supprimer un article</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="collapse multi-collapse" id="multiCollapseExample2">
                    <div class="card card-body">
                        <a href="addcategorie.php">Ajouter une categorie</a>
                        <a href="edit_deletecategorie.php">Modifier / Supprimer une categorie</a>
                    </div>
                </div>
            </div>
        </div>
        </div>
               
        <div class="collapse" id="collapseArticle">
            <div class="card card-body">
                
            </div>
        </div>
        <br>
        
        <div class="collapse" id="collapseCategorie">
            <div class="card card-body">
                <a href="addcategorie.php">Ajouter une categorie</a><br>
                <a href="edit_deletecategorie.php">Modifier / Supprimer une categorie</a><br>
            </div>
        </div>
    </main>
</body>

</html>




