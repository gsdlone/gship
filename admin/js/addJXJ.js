$(document).ready(function($){
///////////////////////////////

$("#btnAddJXJ").click(function(){
  $("#modalAddJXJ").modal();
  $("#newJXJ").val('');
  for(i=0; i<8; i++){
    $('#jxj'+i).prop('checked',false);
  }
  $("#submitJXJ").val("Add JXJ");
});

function errchk(id, str){
  blank = '不能为空';
  alert(str + blank);
  $(id).focus();
  return false;
}

$("#submitJXJ").click(function(){
  pass = {};
  id = '#newJXJ';
  pass.newJXJ = $(id).val();
  if(pass.newJXJ == ''){
    return errchk(id, '奖学金名称');
  }
  var tmp0;
  tmp0 = /[.|]/.test(pass.newJXJ);
  if (tmp0) {
    alert("奖学金名称不可包含字符 . 或 |");
    $("#newJXJ").focus();
    return false;
  }

  var tmp, ntotal, idx;
  ntotal = 0;
  for(i=0; i<8; i++){
    tmp = $('#jxj'+i).prop('checked');
    if(tmp) {
      ntotal++;
      idx = i;
    }
  }
  if(ntotal>1){
    $('#jxj'+idx).focus();
    alert("奖学金类别不能多于 1 个");
    return false;
  }else if(ntotal==0){
    $('#jxj0').focus();
    alert("请选择一个奖学金类别");
    return false;
  }else if(ntotal==1){
    pass.kind = idx;
  }

  action = "addJXJ.php";
  $.post(action, pass, function(data){
    if( data == -1 ) {
      alert("该奖学金已存在，请选择另一奖学金名称！");
    }
    location.reload();
  });
});

///////////////////////////////
});
