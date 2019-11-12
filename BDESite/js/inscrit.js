$(function() {
     $('button').click(function(){
       var x = $(this).attr('id');
       x = x.replace('like','');
       alert(x);
       
     });
  /*var inscrit = $('#like');
  inscrit.on('load', function(){
    $.ajax({
      url: '../manifestations/like.php',

    });
      inscrit.text('Aimé!');
  });*/
   
  });