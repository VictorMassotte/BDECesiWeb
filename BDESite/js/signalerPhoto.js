$(function() {
  
    $('#signalerPhoto button').click(function(){
        
      var x = $(this).attr('id');
      
      x = x.replace('signalerPhoto', '');
      
     
     
      photo = x; 
   
     
      $.ajax({
        url: '../manifestation/signalerPhoto.php',
        type: 'POST',
        data: { Photo: photo},
      })
      .done(function (data) {
          
       
          
        successFunction(data); })
      .fail(function (jqXHR, textStatus, errorThrown) { 
        alert(fail);
        serrorFunction(); 
      });
     
      
  });
  
   
    });