<?php
session_start();

if(isset($_SESSION['membre_BDE'])){
    //fonction poster manifestation
    echo "<a href=\"ajoutManifestation.php\">Poster une manifestation</a>";
    
    //liste des inscrits aux manifestations
    echo "<a href=\"membreInscrits.php\">Lister les membres inscrits à une manifestation</a>";
    //génération d'un formulaire qui prends en entrée la manifestation (selon une liste déroulante, pour eviter les fautes de frappe)
    //traitement de la requête
    
    //interaction avec les commentaires (bouton direct dans evenements passés si l'utilisateur est sous session d'aministrateur)
  
    echo "<a href=\"suppPhoto.php\">Supprimer une photo</a>";
    
   
    echo "<a href=\"supprimer.php\">Supprimer un commentaire</a>";
    
    //génération d'un formulaire qui prends en entrée la manifestation (que celles passées)
    //redirection sur la génération de l'ensemble des comentaires relatifs à la manifestation avec identifiants respectifs mais classés par date d'envoi
    //formulaire pour selectionner le commentaire sur lequel on souhaite appliquer une acction : -supprimer ou -signaler
    //lorsque la séléction est faite, on obtient la liste des commentaires relatifs à la manifestation choisie avec leurs identifiants respectifs + génération d'un champ 
    
}else{
    header('Location: ../Module_Connexion_Inscription/Connexion.php');
}
?>