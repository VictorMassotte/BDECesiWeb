<?php
session_start();
if(isset($_SESSION['membre_BDE'])){
    //fonction poster manifestation
    echo "<button type=\"button\" class=\"btn btn-outline-primary\">Poster une manifestation</button>";
    //génération d'un formulaire en method post qui permet d'entrer les valeurs de la manifestation à ajouter
    //traitement du formulaire 
    
    //liste des inscrits aux manifestations
    echo "<button type=\"button\" class=\"btn btn-outline-primary\">Lister les inscrits à une manifestation</button>";
    //génération d'un formulaire qui prends en entrée la manifestation (selon une liste déroulante, pour eviter les fautes de frappe)
    //traitement de la requête
    
    //interaction avec les commentaires (bouton direct dans evenements passés si l'utilisateur est sous session d'aministrateur)
    echo "<button type=\"button\" class=\"btn btn-outline-primary\">Intéragir avec des commentaires</button>";
    //génération d'un formulaire qui prends en entrée la manifestation (que celles passées)
    //redirection sur la génération de l'ensemble des comentaires relatifs à la manifestation avec identifiants respectifs mais classés par date d'envoi
    //formulaire pour selectionner le commentaire sur lequel on souhaite appliquer une acction : -supprimer ou -signaler
    //lorsque la séléction est faite, on obtient la liste des commentaires relatifs à la manifestation choisie avec leurs identifiants respectifs + génération d'un champ 
    
}else{
    header('Location: ../Module_Connexion_Inscription/Connexion.php');
}
?>