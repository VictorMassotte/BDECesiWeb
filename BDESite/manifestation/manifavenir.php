<?php
$dateactuelle = new DateTime('now');//2019-11-10
$datetime1 = new DateTime('2019-11-15');//à la place il faut mettre la date de l'evenement récupéré de la bdd dans le format y-m-d
$interval = $datetime1->diff($dateactuelle);
if($interval->format('%R%a')<0){
    echo"négatif <br> donc à placer dans evenements à venir";
}else{
    //ne rien faire 
}
?>