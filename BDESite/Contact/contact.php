<?php
session_start();
if(isset($_SESSION['login'])){
    include('../boutique/bdd.php');
}else{
    header('Location: ../Module_Connexion_Inscription/Connexion.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">


<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>



<link rel="stylesheet" href="css/fonction.css">

<title>Contact</title>


</head>
<?php  require_once("../elements/menu.php"); ?>
<body>
    

<div class="jumbotron">
             <h1 class="display-6">CONTACT</h1>
        </div>
<form method="post">
  
  <div class="form-group">
    <label >Mail</label>
    <select class="form-control" id="exampleFormControlSelect1" name="mail">
      <?php
      $rqt = $bdd->query('SELECT MAIL from users WHERE STATUS=2');
      
      while ($ligne = $rqt->fetch()) { 
        
        $mail=$ligne['MAIL'];
        echo "<option value=\"".$mail."\">".$mail."</option>";
    }
      ?>
    </select>
  </div>
  <div class="form-group">
    <label >Objet</label>
    <input type="text" class="form-control" name="objet" >
  </div>
  <label for="exampleFormControlTextarea1">Contenu</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="contenu"></textarea>
  <button type="submit" class="btn btn-primary" name="submit">Send</button>
</form>

<?php require_once("../elements/footer.php");
?>
       
    
</body>
</html>

<?php 
    if (isset($_POST['submit'])){
        $user_mail = $_SESSION['user_Mail'];
        $mail = $_POST['mail'];
        $objet = $_POST['objet'];
        $contenu = $_POST['contenu']."<br><br> Cordialement,<br>".$user_mail;
        $headers = 'From: projet.webcesi92@gmail.com' ."\r\n".
        'MIME-Version: 1.0' ."\r\n".
        'Content-type: text/html; charset=utf-8';
        
        mail($mail, $objet,$contenu, $headers);
    }
?>