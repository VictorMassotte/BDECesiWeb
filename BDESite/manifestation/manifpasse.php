<?php
$dateactuelle = new DateTime('now');//2019-11-10
$datetime1 = new DateTime('2019-11-15');//à la place il faut mettre la date de l'evenement récupéré de la bdd dans le format y-m-d
$interval = $datetime1->diff($dateactuelle);
if($interval->format('%R%a')<0){
    // ne rien faire
}else{
    echo"positif <br> donc à placer dans evenements passés";
}
//ajouter la récupération de la date pour un événement
//récuperer chaque element dans un json
//apliquer cette condition à toutes les manifestations de la bdd, et les mettre en page (faire en sorte que ça s'affiche sous forme de tableau avec des pages différentes)

?>
