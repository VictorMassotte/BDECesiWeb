$(function() {
  
    $('#signaler button').click(function(){
        
      var x = $(this).attr('id');
      
      x = x.replace('signaler', '');
      
     
     
      id_com = x; 
   
     
      $.ajax({
        url: '../manifestation/signalerCommentairePhoto.php',
        type: 'POST',
        data: { ID: id_com},
      })
      .done(function (data) {
          alert(data);
       
          
        successFunction(data); })
      .fail(function (jqXHR, textStatus, errorThrown) { 
        alert(fail);
        serrorFunction(); 
      });
     
      
  });
  
   
    });