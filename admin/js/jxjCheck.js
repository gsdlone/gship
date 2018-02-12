$(document).ready(function($){

$(".btn-check").click(function(){
  var btn, pass, ntr, ntp, check;
  var test1, test2;
  btn = $(this);
  pass = {};
  pass.id = btn.attr("id").split("l")[1];
  pass.choice = btn.text();
  pass.award = $("#award").text();
  pass.awardid = $("#award"+pass.id).text();
  pass.stat = $("#stat"+pass.id).text();
  pass.cardid = $("#cardid").text();

  ntr = $("#ntr").text();
  ntp = $("#ntp").text();
  if ( ntr == ntp ) {
    test1 = 1;
  } else {
    test1 = 0;
  }
  check = $('#check'+pass.id).text();
  if( pass.choice == "通过" && check != "已审核" ) {
    ntp = parseFloat(ntp) + 1;
    $("#ntp").html(ntp);
  }
  if( pass.choice == "修改" && check == "已审核" ) {
    ntp = parseFloat(ntp) - 1;
    $("#ntp").html(ntp);
  }
  if ( ntp == ntr ) {
    pass.pass = "1";
    test2 = 1;
  } else {
    pass.pass = "0";
    test2 = 0;
  }
  if ( test1 == test2 ) {
    pass.up = 'F';
  } else {
    pass.up = 'T';
  }


  $.ajax({
    method: "POST",
    url: "jxjCheck.php",
    data: pass
  }).done(function( msg ) {
    if ( pass.choice == "通过" ) {
      $("#check"+pass.id).html("<span style='color:green'>已审核</span>");
    } else if ( pass.choice == "修改" ) {
      $("#check"+pass.id).html("<span style='color:orange'>待修改</span>");
    }
  });
});

});
