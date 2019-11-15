$(function() {
  
    $('#signalerManif button').click(function(){
        
      var x = $(this).attr('id');
      
      x = x.replace('signalerManif', '');
      
     
     
      id_manif = x; 
   
     
      $.ajax({
        url: '../manifestation/signalerManif.php',
        type: 'POST',
        data: { ID: id_manif},
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