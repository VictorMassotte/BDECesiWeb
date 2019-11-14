$(function() {
  
    $('#photo button').click(function(){
      var x = $(this).attr('id');
      
      x = x.replace('photo', '');
      
     id = x;
     
    
     
      $.ajax({
        url: '../manifestation/listePhoto.php',
        type: 'POST',
        data: { id_manifestation: id},
      })
      .done(function (data) {
        
      
        successFunction(data); })
      .fail(function (jqXHR, textStatus, errorThrown) { 
        alert("fail");
        serrorFunction(); 
      });
     
      
  });
  
   
    });