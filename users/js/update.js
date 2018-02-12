$(document).ready(function($){
$("#btn_update").click(function(){
  $("#btn_update").attr('disabled','disabled');
  var i, j, ntr, tmp, ids, jxj;
  var tds, counter, flag;
  var tmpx, tmpy, x, y, n, z;
  var totalif, ntotal;
  ntr = $("#ntrs").text();
  tmp = $("#idselect").text();
  ids = tmp.split("|");
  idjxj = ids[0]; // id of award
  jxj = $("#btnJXJSel").text(); // name of award
  flag = 0;
  ntotal = 0;
  for ( i=1; i<ids.length; i++ ) {
    tds = $("#btnCheck"+ids[i]).parent().parent().parent("tr").children("td");
    counter  = tds.eq(0).attr('id');
    tmp = $("#btnCheck"+ids[i]).prop("checked");
    tmpx = $("#jstatus"+ids[i]).text();
    tmpy = $("#jstatusx"+ids[i]).text();
    x = tmpx.split("|");
    y = tmpy.split("|");
    n = parseFloat(x.length - 1);
    pass = {};
    pass.id = counter;
    pass.x = "";
    pass.y = "";
    if ( tmp ) {
      flag = 1;
      ntotal++;
      for ( k=0; k<n; k++ ) {
        if ( x[k] != jxj ) {
          pass.x = pass.x + x[k] + "|";
          pass.y = pass.y + y[k] + "|";
        }
      }
      pass.x = pass.x + jxj + "|";
      pass.y = pass.y + idjxj + ".F" + "|";
    } else {
      for ( k=0; k<n; k++ ) {
        if ( x[k] != jxj ) {
          pass.x = pass.x + x[k] + "|";
          pass.y = pass.y + y[k] + "|";
        }
      }
    }
    //alert(pass.id);
    //alert(pass.x);
    //alert(pass.y);
    $.post("update.php", pass, function(){});
  }
////////////////////////
  x = $("#myjxjs").text().split("|"); // selected award
  z = $("#myjxjsx").text().split("|"); // selected award's number of paper and totalif
  n = parseFloat(x.length - 1);
  xpass = {};
  xpass.jxj = "";
  xpass.nif = "";
  xpass.id = $("#myjxjid").text(); // selected scholarships
  totalif = $("#totalIF").text();
  for ( k=0; k<n; k++ ) { // remain the other awards, and remove this award
    if ( x[k] != jxj ) {
      xpass.jxj = xpass.jxj + x[k] + "|";
      xpass.nif = xpass.nif + z[k] + "|";
    }
  }
  if ( flag == 1 ) { // have papar selected, add this award
    xpass.jxj = xpass.jxj + jxj + "|";
    xpass.nif = xpass.nif + ntotal + "x" + totalif + "x0" + "|";
  }
  $.post("namelist.php", xpass, function(){
    location.reload();
  });
});
});
