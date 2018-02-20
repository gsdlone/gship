$(document).ready(function($){

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
var ntmp = new Array();
var tmp = new Array();
var name = new Array();
var x = new Array();
ntotal = $("#ntotal").text();
ny = 9; // td elements
njxj = -1;
for ( i=1; i<=ntotal; i++ ) {
  ntmp[i] = $("#t"+i+"n").text();
  name[i] = new Array();
  for ( j=1; j<=ntmp[i]; j++ ) {
    name[i][j] = $("#x"+i+"y"+j).text();
    njxj++;
    tmp[njxj] = name[i][j];
  }
}

var jxj = unique(tmp);
njxj = jxj.length;

for ( ijxj=0; ijxj<njxj; ijxj++ ) {
  str = "<tr><td class='jxjTitle' colspan=10>" + jxj[ijxj] +"</td></tr>";
  $("#mtb").append(str);
  k = 0;
  totalif = 0.0;
  for ( i=1; i<=ntotal; i++ ) {
    x[i] = new Array();
    for ( j=2; j<=ny; j++ ) {
      x[i][j] = $("#t"+i+j).html();
    }
  }
  for ( i=1; i<=ntotal; i++ ) {
    flag = 0;
    for ( j=1; j<=ntmp[i]; j++ ) {
      if ( jxj[ijxj] == name[i][j] ) {
        flag = 1;
        k++;
      }
    }
    if ( flag == 1 ) {
      totalif = parseFloat(totalif) + parseFloat(x[i][8]*x[i][9]);
      str = "";
      str = str + "<tr>";
      str = str + "<td>" + k + "</td>";
      for ( j=2; j<=ny; j++ ) {
        str = str + "<td>" + x[i][j] + "</td>";
      }
      str = str + "</tr>";
      $("#mtb").append(str);
    }
  }
  str = "<tr><td colspan=10>加权分区分数：" + totalif.toFixed(3) +"</td></tr>";
  $("#mtb").append(str);
}

});
