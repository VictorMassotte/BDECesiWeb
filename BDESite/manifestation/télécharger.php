<?php
session_start();
if(isset($_SESSION['intervenant_CESI'])){
    include('../boutique/bdd.php');
}else{
    header('Location: ../Module_Connexion_Inscription/Connexion.php');
}
$photo = array();
$files1 = scandir("../boutique/admin/imgs/");
$dossier = array();
$rqt = $bdd->query('SELECT PHOTO FROM manifestations INNER JOIN ajouter_photo ON manifestations.ID=ajouter_photo.ID ');
while ($ligne = $rqt->fetch()) {
$photo[]=$ligne['PHOTO'];
}
$chemin ="../boutique/admin/imgs/";
$zip = new ZipArchive(); 
      if($zip->open('Zip.zip', ZipArchive::CREATE) === true)
      {
        foreach($photo as $key=>$photos){
            foreach($files1 as $key1=>$files){
                if ($photos == $files){

                    $files = $chemin.$files;
                   //on remplit l'archive
                    $zip->addFile($files);
                    
                }
            }
        }
        $zip->extractTo('.');
        //on l'extrait
	
	
        // Et on referme l'archive.
    $zip->close();
    //la redirection provoque le télechargement
    header('Location: Zip.zip');

   
      }
      else
      {
        echo 'Impossible d&#039;ouvrir &quot;Zip.zip<br/>';
	// Traitement des erreurs avec un switch(), par exemple.
      }


?>