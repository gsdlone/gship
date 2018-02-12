$(document).ready(function($){

$(".btn-oc").click(function(){
  var btn, pass;
  btn = $(this);
  pass = {};
  pass.id = btn.attr("id").split("o")[1];
  pass.stat = btn.text();
  
  $.ajax({
    method: "POST",
    url: "jxjOC.php",
    data: pass
  }).done(function( msg ) {
    if ( pass.stat == "开启" ) {
      btn.html("关闭");
      btn.removeClass("btn-warning");
      btn.addClass("btn-success");
    } else if ( pass.stat == "关闭" ) {
      btn.html("开启");
      btn.removeClass("btn-success");
      btn.addClass("btn-warning");
    }
  });
});

});
