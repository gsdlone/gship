$(document).ready(function($){
///////////////////////////////

$("#btnDelJXJ").click(function(){
  var n, i;
  var id = []; 
  $("#modalDelJXJ").modal();
  n = $("#ndel").text();
  for(i=0; i<=n; i++){
    id[i] = $('#delx'+i).text();
    $('#del'+id[i]).prop('checked',false);
  }

  $("#delJXJ").click(function(){
    var stat;
    var pass = {};
    for(i=0; i<=n; i++){
      stat = $('#del'+id[i]).prop('checked');
      if ( stat ) {
        pass.id = id[i];
        pass.award = $('#dely'+id[i]).text();
        $.ajax({
          method: "POST",
          url: "delJXJ.php",
          async: false,
          data: pass
        });
      }
    }
    location.reload();
  });
});


///////////////////////////////
});
