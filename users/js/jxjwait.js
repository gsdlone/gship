$(document).ready(function($){
  function errchk(id, str){
    blank = '不能为空';
    alert(str + blank);
    $(id).focus();
    return false;
  }

  idradio = "input[id='coaffi']";
  $(idradio).iCheck({
    checkboxClass: 'icheckbox_square-aero',
    increaseArea: '20%'
  });

  idradio = "input[id='coauthor']";
  $(idradio).iCheck({
    checkboxClass: 'icheckbox_square-aero',
    increaseArea: '20%'
  });

  idradio = "input[id='supervisor']";
  $(idradio).iCheck({
    checkboxClass: 'icheckbox_square-aero',
    increaseArea: '20%'
  });



var unique = function(origArr) {
  var newArr = [],
    origLen = origArr.length,
    found, x, y;
  for (x = 0; x < origLen; x++) {
    found = undefined;
    for (y = 0; y < newArr.length; y++) {
      if (origArr[x] === newArr[y]) {
        found = true;
        break;
      }
    }
    if (!found) {
      newArr.push(origArr[x]);
    }
  }
  return newArr;
}

var ntotal, x, y, ntmp, flag, totalif;
var i, j, k, str, ny, njxj, ijxj;
var tmpstr;
var ntmp = new Array();
var tmp = new Array();
var name = new Array();
var namex = new Array();
var x = new Array();
ntotal = $("#ntotal").text();
ny = 10; // td elements
njxj = -1;
for ( i=1; i<=ntotal; i++ ) {
  ntmp[i] = $("#t"+i+"n").text();
  name[i] = new Array();
  namex[i] = new Array();
  for ( j=1; j<=ntmp[i]; j++ ) {
    name[i][j] = $("#x"+i+"y"+j).text();
    namex[i][j] = $("#ax"+i+"y"+j).text();
    njxj++;
    tmp[njxj] = name[i][j];
  }
}

var jxj = unique(tmp);
njxj = jxj.length;

for ( ijxj=0; ijxj<njxj; ijxj++ ) {
  str = "<tr><td class='jxjTitle' colspan=11>" + jxj[ijxj] +"</td></tr>";
  $("#mtb").append(str);
  k = 0;
  totalif = 0.0;
  for ( i=1; i<=ntotal; i++ ) {
    x[i] = new Array();
    for ( j=2; j<=ny; j++ ) {
      x[i][j] = $("#t"+i+"x"+j).html();
    }
  }
  for ( i=1; i<=ntotal; i++ ) {
    flag = 0;
    for ( j=1; j<=ntmp[i]; j++ ) {
      if ( jxj[ijxj] == name[i][j] ) {
        flag = 1;
        k++;
        if ( namex[i][j] == 'F') {
          tmpstr = "<span id='"+i+"|"+jxj[ijxj]+"' class='jxjmodify' style='color:red'>待审核（点击修改）</span>";
        } else if ( namex[i][j] == 'W' ) {
          tmpstr = "<span id='"+i+"|"+jxj[ijxj]+"' class='jxjmodify' style='color:orange'>待修改（点击修改）</span>";
        } else if ( namex[i][j] == 'R' ) {
          tmpstr = "<span id='"+i+"|"+jxj[ijxj]+"' class='jxjmodify' style='color:blue'>已修改（点击修改）</span>";
        } else if ( namex[i][j] == 'P' ) {
          tmpstr = "<span style='color:green'>已审核</span>";
        }
      }
    }
    if ( flag == 1 ) {
      totalif = parseFloat(totalif) + parseFloat(x[i][8]*x[i][9]);
      str = "";
      str = str + "<tr>";
      str = str + "<td>" + k + "</td>";
      for ( j=2; j<=9; j++ ) { // ny-1 = 9
         str = str + "<td>" + x[i][j] + "</td>";
      }
      str = str + "<td>" + tmpstr + "</td>";
      str = str + "</tr>";
      $("#mtb").append(str);
    }
  }
  str = "<tr><td colspan=10>加权影响因子：" + totalif.toFixed(3) +"</td></tr>";
  $("#mtb").append(str);
}

$(".jxjmodify").click(function(){
  var btn, id, pass, tmp;
  $("#addpaper").modal();
  pass = {};
  btn = $(this);
  tmp = btn.attr('id').split("|");
  n = tmp[0];
  pass.award = tmp[1];
  tmp  = $("#t"+n+"x5").text().split("/");
  pass.journal = $("#t"+n+"x2").text();
  pass.title = $("#t"+n+"x3").text();
  pass.doi = $("#t"+n+"x4").text();
  pass.nauthors = tmp[1];
  pass.seq = tmp[0];
  pass.coaffi = $("#t"+n+"x6").text();
  pass.coauthor = $("#t"+n+"x7").text();
  pass.id = $("#t"+n+"x10").text();
  pass.ncoauthor = $("#t"+n+"x11").text();
  pass.mycoauthor = $("#t"+n+"x12").text();
  pass.supervisor = $("#t"+n+"x13").text();
  pass.stat = btn.text();

  $("#journal").val(pass.journal);
  $("#title").val(pass.title);
  $("#doi").val(pass.doi);
  $("#nauthors").val(tmp[1]);
  $("#seq").val(tmp[0]);
  $("#ncoauthor").val(pass.ncoauthor);
  $("#mycoauthor").val(pass.mycoauthor);
  if ( pass.coaffi == '是') {
    $('#coaffi').iCheck('check');
  } else {
    $('#coaffi').iCheck('uncheck');
  }
  if ( pass.coauthor == '是') {
    $('#coauthor').iCheck('check');
  } else {
    $('#coauthor').iCheck('uncheck');
  }
  if ( pass.supervisor == '是') {
    $('#supervisor').iCheck('check');
  } else {
    $('#supervisor').iCheck('uncheck');
  }

$("#submit").click(function(){
    id = "#journal";
    pass.journal = $(id).val();
    if(pass.journal == ''){
      return errchk(id, '期刊名')
    }

    id = '#title';
    pass.title = $('#title').val();
    if(pass.title == ''){
      return errchk(id, '文章标题');
    }

    id = '#doi';
    pass.doi = $('#doi').val();
    if(pass.doi == ''){
      return errchk(id, 'DOI');
    }

    id = '#nauthors'
    pass.nauthors = $(id).val();
    if(pass.nauthors == ''){
      return errchk(id, '作者总数');
    }

    reg = /^[1-9][0-9]*$/;
    if(!reg.test(pass.nauthors)){
      alert('请输入正整数');
      $(id).val('');
      $(id).focus();
      return false;
    }

    id = '#seq';
    pass.seq = $(id).val();
    if(pass.seq == ''){
      return errchk(id, '署名顺序');
    }

    if(!reg.test(pass.seq)){
      alert('请输入正整数');
      $(id).val('');
      $(id).focus();
      return false;
    }

    id = '#ncoauthor';
    pass.ncoauthor = $(id).val();
    if(pass.ncoauthor == ''){
      return errchk(id, '共同一作作者数');
    }
    if(!reg.test(pass.ncoauthor)){
      alert('请输入正整数');
      $(id).val('');
      $(id).focus();
      return false;
    }

    id = '#mycoauthor';
    pass.mycoauthor = $(id).val();
    if(pass.mycoauthor == ''){
      return errchk(id, '共同一作作者署名顺序');
    }
    if(!reg.test(pass.mycoauthor)){
      alert('请输入正整数');
      $(id).val('');
      $(id).focus();
      return false;
    }

    if(pass.seq > pass.nauthors){
      alert('署名顺序不应大于作者总数');
      return false;
    }

    if(pass.mycoauthor > pass.ncoauthor){
      alert('第一作者署名顺序不应大于第一作者作者总数');
      return false;
    }

    pass.coaffi   = $('#coaffi').is(':checked');
    pass.coauthor = $('#coauthor').is(':checked');
    pass.supervisor = $('#supervisor').is(':checked');

    if(pass.coauthor && pass.seq > pass.ncoauthor){
        alert('在共同一作情况下，署名顺序不应大于共同一作总数');
        return false;
    }


  $.post('modiPaper.php', pass, function(data){
    if(data == -1){
      alert('DOI为\''+pass.doi+'\'的文章重复，请检查。')
    }else{
      location.reload();
    }
  });

});

});

});
