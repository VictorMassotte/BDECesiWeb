$(function() {
  
    $('#supprimer button').click(function(){
        
      var x = $(this).attr('id');
      
      x = x.replace('supprimer', '');
      
     // x = x.split('-');
     // id = x[0];
      id_com = x;
      //id_user = x[2];
      
    
     
    
    
     
      $.ajax({
        url: '../manifestation/supprimer.php',
        type: 'POST',
        data: { id_Com: id_com},
      })
      .done(function (data) {
       
          
          setTimeout(function() 
          {
            location.reload();  //Refresh page
          }, 1000);
          alert('commentaire');
        successFunction(data); })
      .fail(function (jqXHR, textStatus, errorThrown) { 
        
        serrorFunction(); 
      });
     
      
  });
  
   
    });