$(function() {
     
  var inscrit = $('#like');
  inscrit.on('load', function(){
    $.ajax({
      url: '../manifestations/like.php',

    });
      inscrit.text('Aimé!');
  });
   
  });