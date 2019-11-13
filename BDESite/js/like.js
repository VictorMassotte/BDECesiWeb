$(function() {
  
  $('#bouton button').click(function(){
    var x = $(this).attr('id');
    
    x = x.replace('like', '');
    
    x = x.split('-');
    id = x[0];
    nom = x[1];
    test = ".like";
    test = test.concat('', id);
   ;
  
   
    $.ajax({
      url: '../manifestation/like.php',
      type: 'POST',
      data: { id_manifestation: id, manif: nom, name: "Sannier", firstname: "Gauthier" },
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