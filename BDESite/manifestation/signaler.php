<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=projet_web;charset=utf8', 'root', '');
var_dump($_POST);
//get l'utilisateur (id)($user)
if (isset($_POST['ID'])){
   
    
    $id_com = $_POST['ID'];
    $rqtSpe = $bdd->prepare('SELECT ID_COMMENTAIRE, CONTENU, users.MAIL FROM `commenter`INNER JOIN `users` ON commenter.ID_USERS=users.ID WHERE ID_COMMENTAIRE=:idc');
    
    $rqtSpe->bindValue(':idc',$id_com, PDO::PARAM_STR);
    $rqtSpe->execute();
    $contenu;
    $mail;
    $com_id;
    if ($ligne=$rqtSpe->fetch())
    {
        
        $contenu = $ligne['CONTENU'];
        $mail = $ligne['MAIL'];
        $com_id = $ligne['ID_COMMENTAIRE'];
    }
   
    $rqtSpe->closeCursor();
    $body = $com_id." ".$contenu." ".$mail;
    
    $headers = 'From: projet.webcesi92@gmail.com' ."\r\n".
    'MIME-Version: 1.0' ."\r\n".
    'Content-type: text/html; charset=utf-8';
    
    $rqt = $bdd->prepare('SELECT MAIL from users WHERE STATUS=2');
    $rqt->execute();
    while($ligne1=$rqt->fetch()){
      
       mail($ligne1['MAIL'], "Signalement",$body, $headers);
       echo $ligne1['MAIL'];
        
    }
    $rqt->closeCursor(); 
    
    
}


//header('Location: manifpasse.php');
?>