$(document).ready(function($){
  var nactive, i, j, x;
  nactive = $("#nactive").text();
  for ( i=1; i<=nactive; i++ ) {
    x = $("#t"+i).text();
    $(".jxjDown").append("<li class='dropjxj'><a href=#>"+x+"</a></li>");
  }

$(".dropjxj").click(function(){
  var btn, x, n, nactive;
  var i;
  btn = $(this);
  x = $(this).text();
  n = x.split(".")[0];
  nactive = $("#nactive").text();
  for ( i=1; i<=nactive; i++ ) {
    if ( i == n ) {
      $("#tab"+i).show();
    } else {
      $("#tab"+i).hide();
    }
  }
});

});
