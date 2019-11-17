$(function() {
  
    $('#signaler input').click(function(){
        
      var x = $(this).attr('id');
      
      x = x.replace('signaler', '');
      
     
     
      id_com = x; 
   
     
      $.ajax({
        url: '../manifestation/signaler.php',
        type: 'POST',
        data: { ID: id_com},
      })
      .done(function (data) {
         
       
          
        successFunction(data); })
      .fail(function (jqXHR, textStatus, errorThrown) { 
        alert(fail);
        serrorFunction(); 
      });
     
      
  });
  
   
    });