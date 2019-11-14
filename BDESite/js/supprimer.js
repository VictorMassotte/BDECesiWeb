$(function() {
  
    $('#supprimer button').click(function(){
        
      var x = $(this).attr('id');
      
      x = x.replace('supprimer', '');
      
      x = x.split('-');
      id = x[0];
      id_com = x[1];
      id_user = x[2];
      
    
     
     ;
    
     
      $.ajax({
        url: '../manifestation/supprimer.php',
        type: 'POST',
        data: { id_manifestation: id, id_Com: id_com, id_User: id_user},
      })
      .done(function (data) {
       
          
          setTimeout(function() 
          {
            location.reload();  //Refresh page
          }, 1000);
          alert('commentaire');
        successFunction(data); })
      .fail(function (jqXHR, textStatus, errorThrown,data) { 
        
        serrorFunction(); 
      });
     
      
  });
  
   
    });