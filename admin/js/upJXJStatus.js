$(document).ready(function($){
  $("#btnJXJStatus").click(function(){
     $("#modalUpJXJStatus").modal();
       var njxjs = $("#ujxjs").html();
       for(i=0; i<=njxjs; i++){
         var statx = $("#pjxj"+i).html();
         if(statx=="开启"){
           $('#ujxj'+i).prop('checked',true);
         }else if(statx=="关闭"){
           $('#ujxj'+i).prop('checked',false);
         }
         statx = $("#pjxjx"+i).html();
         if(statx=="已入档"){
           $('#ujxjx'+i).prop('checked',true);
           $('#ujxj'+i).prop('checked',false);
           $('#ujxjx'+i).attr('disabled','disabled');
         }else if(statx=="未入档"){
           $('#ujxjx'+i).prop('checked',false);
         }
       }
  });

  $("#submitStatus").click(function(){
    var pass={};
    var njxjs = $("#ujxjs").html();
    pass.ntotal = njxjs;
    for(i=0; i<=njxjs; i++){
      tmp = $('#ujxj'+i).prop('checked');
      var namex = "ax"+i;
      var namey = "ay"+i;
      var nameid = "id"+i;
      pass[nameid] = $('#jid'+i).html();
      if(tmp) {
        pass[namex] = 0;
      }else{
        pass[namex] = 1;
      }
      tmp = $('#ujxjx'+i).prop('checked');
      if(tmp) {
        pass[namey] = 1;
      }else{
        pass[namey] = 0;
      }
      //alert(pass[nameid]);
      //alert(pass[namex]);
      //alert(pass[namey]);
    }

    action = "upJXJStatus.php";
    $.post(action, pass, function(){
      location.reload();
    });
  });
});
