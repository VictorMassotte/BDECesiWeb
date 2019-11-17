$(function() {
  
    $('#bouton input').click(function(){
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
        
          alert(data);
       $(test).val(data);
        successFunction(data); })
      .fail(function (jqXHR, textStatus, errorThrown) { 
        alert("fail");
        serrorFunction(); 
      });
     
      
  });
  
   
    });