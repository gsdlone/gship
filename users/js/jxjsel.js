$(document).ready(function($){

$(".btn-select").click(function(){
  var idx, idy, stat, tmp;
  var ifx, wtx, j, totalif;
  idx = $(this).attr("id");
  idy = idx.split("l");
  j = idy[1];
  ifx = $("#if"+j).text();
  wtx = $("#w"+j).text();
  tmp = $("#totalIF").text();
  stat = $("#btnCheck"+j).prop("checked");
  if ( stat ) {
    $("#btnCheck"+j).prop("checked",false);
    totalif = parseFloat(tmp) - parseFloat(ifx*wtx);
  } else {
    $("#btnCheck"+j).prop("checked",true);
    totalif = parseFloat(tmp) + parseFloat(ifx*wtx);
  }
  totalif = totalif.toFixed(3);
  $("#totalIF").html(totalif);
});

$(".seljxj").click(function(){
  var i, j, k, id1, id2, idx, idy;
  var tmp, ntotal, ntr, x, n;
  var idjxj, nrel, flag, i1, j1, k1, nz;
  var tmpx, flagx, jxjname;
  var totalif, ifx, wtx;
  
// clean up content in idselect
// get the name of selected scholarship
  tmp = $(this).text().split(".");
  jxjkind = $("#li"+tmp[0]).html();
  jxjname = tmp[1].replace(/^\s/, "");
  $("#btnJXJSel").html(jxjname);
  $("#idselect").html(jxjkind);

// loop through journals
  totalif = 0;
  ntr = $("#ntrs").text();
  for ( j=1; j<=ntr; j++ ) {
    x = $("#jstatus"+j).text().split("|"); // jxjname included
    y = $("#jstatusx"+j).text().split("|");
    flag = 0; flagx = 0; flagy = 0;
    var ix1, ix2;
    ix1 = 0;
    ix2 = 0;
    for ( k=0; k<x.length; k++ ) {
     if ( y[k] ) {
      ix1 = parseFloat( ix1 ) + 1;
      tmp = y[k].split(".");
      if ( tmp[1] == "T" ) { flagx = 1; ix2 = parseFloat( ix2 ) + 1; } // archived
      if ( x[k] == jxjname ) { flag = 2; break; }
      // if idx and idjxj not belong to the same set.
      if ( tmp[0] != 2 ) {
        if ( tmp[0] == jxjkind ) { flag = 1; } // same set, not display
      }
     }
    }
    if ( ix1 != ix2 ) { flagy = 1; } // contain flag except T, can not delete.
////////////////////////////
    ifx = $("#if"+j).text();
    wtx = $("#w"+j).text();
    ///////////////////////  if papaer has been archived, can not delete
    if ( flagx == 1 ) { // paper has been archived.
      $("#btn-delete"+j).attr('disabled','disabled');
      $("#btn-edit"+j).attr('disabled',false);
    } else if ( flagx == 0 ) {
      $("#btn-delete"+j).prop('disabled',false);
      $("#btn-edit"+j).prop('disabled',false);
    }
    if ( flagy == 1 ) { // paper has lable can not be deleted.
      $("#btn-delete"+j).attr('disabled','disabled');
    }
    ///////////////////////  
    if ( jxjkind == "x" ) { // list all papers
      totalif = parseFloat(totalif) + parseFloat(ifx*wtx);
      $("#btn_update").hide();
      $("#tr"+j).show();
      $("#btnSel"+j).hide();
      $("#btnCheck"+j).prop("checked",false);
    }else if ( jxjkind != "x" ) {  // list paper by award
      $("#btn_update").show();
      if ( flag == 0 ) { // not the same set, and paper has not include this award
        $("#tr"+j).show();
        $("#btnSel"+j).show();
        $("#btnCheck"+j).attr('disabled','disabled');
        $("#btnCheck"+j).prop("checked",false);
        tmpx = $("#idselect").text();
        tmpx = tmpx + "|" + j;
        $("#idselect").html(tmpx);
      }else if ( flag == 1 ) { // in the same set, not this award
        $("#tr"+j).hide();
        $("#btnSel"+j).hide();
        $("#btnCheck"+j).prop("checked",false);
      }else if ( flag == 2 ) { // paper include this award
        $("#tr"+j).show();
        $("#btnSel"+j).show();
        $("#btnCheck"+j).attr('disabled','disabled');
        $("#btnCheck"+j).prop("checked",true);
        totalif = parseFloat(totalif) + parseFloat(ifx*wtx);
        tmpx = $("#idselect").text();
        tmpx = tmpx + "|" + j;
        $("#idselect").html(tmpx);
      }
    }
  }
// loop through journals
  totalif = totalif.toFixed(3);
  $("#totalIF").html(totalif);
});

});
