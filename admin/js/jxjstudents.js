$(document).ready(function($){

$(".award").click(function(){
  var btn, pass;
  var award, cardid;
  var idf1, idf2, idf3;
  btn = $(this);
  id = btn.attr("id").split("a")[1];
  award = btn.text();
  
  idf2 = "b"+id;
  idf3 = "c"+id;
  
  $("#"+idf2).val(award);
  $("#"+idf3).submit();
});

});
