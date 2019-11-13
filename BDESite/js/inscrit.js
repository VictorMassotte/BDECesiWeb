$(function() {
 
    $('#bouton button').click(function(){
      var x = $(this).attr('id');
      alert (x);
      x = x.replace('inscrit', '');
      
      x = x.split('-');
      id = x[0];
      nom = x[1];
      test = ".inscrit";
      test = test.concat('', id);
    
     
      $.ajax({
        url: '../manifestation/inscrit.php',
        type: 'POST',
        data: { id_manifestation: id, manif: nom, mail: "gauthiersannier@viacesi.fr" },
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