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
  var tmpx, flagx, flagy, flagz, jxjname;
  var totalif, ifx, wtx;
  
// clean up content in idselect
// get the name of selected scholarship
  tmp = $(this).text().split(".");
  jxjlevel = $("#level"+tmp[0]).html();
  jxjkind = $("#li"+tmp[0]).html();
  jxjname = tmp[1].replace(/^\s/, "");
  $("#btnJXJSel").html(jxjname);
  $("#idselect").html(jxjlevel);

// loop through journals
  totalif = 0;
  ntr = $("#ntrs").text();
  for ( j=1; j<=ntr; j++ ) { // 遍历已提交的所有文章
    x = $("#jstatus"+j).text().split("|"); // 使用过该文章的奖学金
    y = $("#jstatusx"+j).text().split("|"); // 使用该文章的奖学金状态，T 表示已存档
    flag = 0; flagx = 0; flagy = 0;
    // flag  0:Label中不含该级别奖学金或该奖学金 1:Label中含有不是当前奖学金名的同一级别的奖学金 2:文章Label含有该奖学金
    // flagx 0:未入档 1:已入档
    // flagy 1:文章含有除T以外的Label
    var ix1, ix2;
    ix1 = 0;
    ix2 = 0;
    // ix1 label总数
    // ix2 含有T的label数
    for ( k=0; k<x.length; k++ ) { // 遍历使用该文章的奖学金
     if ( y[k] ) {
      ix1 = parseFloat( ix1 ) + 1;
      tmp = y[k].split(".");
      if ( tmp[1] == "T" ) { flagx = 1; ix2 = parseFloat( ix2 ) + 1; } // 已入档
      if ( x[k] == jxjname ) { flag = 2; break; } // 文章Lable含有当前奖学金
      if ( tmp[0] == jxjlevel ) { flag = 1; } // 同一级别，并且label不含当前奖学金
     }
    }
    if ( ix1 != ix2 ) { flagy = 1; } // contain flag except T, can not delete.

    ifx = $("#if"+j).text(); // 影响因子
    wtx = $("#w"+j).text();  // 权重
    affi = $("#affi"+j).text(); // 第一单位
    supervisor = $("#super"+j).text();  // 本所导师
    flagz = 0;
    if ( affi == "false" ) {
      if ( supervisor == "true" && jxjlevel == 3 ) {
        flagz = 0; // 非第一单位，但为本所导师，且奖学金level=3
      } else {
        flagz = 1; // 文章不可参评
      }
    }
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
    if ( jxjkind == "x" ) { // 默认情况，显示所有文章
      totalif = parseFloat(totalif) + parseFloat(ifx*wtx);
      $("#btn_update").hide();
      $("#tr"+j).show();
      $("#btnSel"+j).hide();
      $("#btnCheck"+j).prop("checked",false);
    }else if ( jxjkind != "x" ) {  // 显示可用于评选某一奖学金的文章
      $("#btn_update").show();
      if ( flagz == 0 ) {
        if ( flag == 0 ) { // 已获得奖学金与当前奖学金不在同一级别,同时Label中不含该奖学金名称
          $("#tr"+j).show();
          $("#btnSel"+j).show();
          $("#btnCheck"+j).attr('disabled','disabled');
          $("#btnCheck"+j).prop("checked",false);
          tmpx = $("#idselect").text();
          tmpx = tmpx + "|" + j;
          $("#idselect").html(tmpx);
        }else if ( flag == 1 ) { // in the same level，隐藏该杂志
          $("#tr"+j).hide();
          $("#btnSel"+j).hide();
          $("#btnCheck"+j).prop("checked",false); // 未勾选
        }else if ( flag == 2 ) { // paper include this award
          $("#tr"+j).show();
          $("#btnSel"+j).show();
          $("#btnCheck"+j).attr('disabled','disabled');
          $("#btnCheck"+j).prop("checked",true); // 已勾选
          totalif = parseFloat(totalif) + parseFloat(ifx*wtx);
          tmpx = $("#idselect").text();
          tmpx = tmpx + "|" + j;
          $("#idselect").html(tmpx);
        }
      } else if ( flagz == 1) {
        $("#tr"+j).hide();
        $("#btnSel"+j).hide();
        $("#btnCheck"+j).prop("checked",false); // 未勾选
      }
    }
  }
// loop through journals
  totalif = totalif.toFixed(3);
  $("#totalIF").html(totalif);
});

});
