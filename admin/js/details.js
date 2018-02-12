$(document).ready(function($){

$(".hrefDetails").click(function(){
  var btn, pass;
  var award, cardid;
  var idf1, idf2, idf3;
  btn = $(this);
  id = btn.attr("id").split("|");
  idaward = id[0];
  idcard = id[1];
  award = $("#"+idaward).text();
  cardid = $("#"+idcard).text();
  
  idf1 = idaward + "f";
  idf2 = idaward + "a";
  idf3 = idaward + "c";
  
  $("#"+idf2).val(award);
  $("#"+idf3).val(cardid);
  $("#"+idf1).submit();
});

$(".hrefx").click(function(){
  var btn, id, idf1;
  btn = $(this);
  id = btn.attr("id");
  idf1 = "a"+id;
  $("#"+idf1).submit();
});

});
