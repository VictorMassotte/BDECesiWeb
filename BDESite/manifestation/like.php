<?php
    $bdd = new PDO('mysql:host=localhost;dbname=projet_web;charset=utf8', 'root', '');
    $rqt = $bdd->prepare('SELECT * FROM manifestations WHERE ID=:id');
    $rqt->bindValue(':id',$ligne['ID'], PDO::PARAM_STR);
    $rqt->execute();
    $reponse=$rqt->fetch();
    $rqt->closeCursor();
?>