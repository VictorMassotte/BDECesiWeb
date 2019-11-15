$(function() {
  
    $('#bouton button').click(function(){
      var x = $(this).attr('id');
      
      x = x.replace('like', '');
      
      id = x;
      test = ".like";
      test = test.concat('', id);
    
    
     
      $.ajax({
        url: '../manifestation/likePhoto.php',
        type: 'POST',
        data: { id_Photo: id},
      })
      .done(function (data) {
        
          
       $(test).html(data);
        successFunction(data); })
      .fail(function (jqXHR, textStatus, errorThrown) { 
        alert("fail");
        serrorFunction(); 
      });
     
      
  });
  
   
    });