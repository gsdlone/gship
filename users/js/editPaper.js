$(document).ready(function($){

$(".btn-edit").click(function(){
   $("#addpaper").modal();

  var tds=$(this).parent().parent("tr").children("td");
  var counter  = tds.eq(0).attr('id');
  var journal  = tds.eq(1).text();
  var title    = tds.eq(2).text();  
  var doi      = tds.eq(3).text();
  var nas      = tds.eq(4).text();
  var coaffi   = tds.eq(7).text();
  var coauthor = tds.eq(8).text();
  var ncoauthor = tds.eq(9).text();
  var supervisor = tds.eq(10).text();
  var patent     = tds.eq(11).text();
    
  reg = /[1-9][0-9]*/g;
  var arr = nas.match(reg);
  var nauthors = arr[1];
  var seq      = arr[0];

  id = "#paper-id";
  $(id).val(counter);

  id = "#journal";
  $(id).val(journal);

  id = "#title";
  $(id).val(title);

  id = "#doi";
  $(id).val(doi);

  id = "#nauthors";
  $(id).val(nauthors);

  id = "#seq";
  $(id).val(seq);

  id = "#ncoauthor";
  $(id).val(ncoauthor);

  id = "#coaffi";
  if(coaffi == 'true'){
    $(id).iCheck('check');
  }else{
    $(id).iCheck('uncheck');
  }

  id = "#coauthor";
  if(coauthor == 'true'){
      $(id).iCheck('check');
  }else{
      $(id).iCheck('uncheck');
      $("#totalnumlabel").hide();
      $("#ncoauthor").hide();
  }

  $(id).on('ifChecked', function(event){
      $("#totalnumlabel").show();
      $("#ncoauthor").show();      
  });
  $(id).on('ifUnchecked', function(event){
      $("#totalnumlabel").hide();
      $("#ncoauthor").val('1');      
      $("#ncoauthor").hide();
  });

  id = "#supervisor";
  if(supervisor == 'true'){
    $(id).iCheck('check');
  }else{
    $(id).iCheck('uncheck');
  }

  id = "#patent";
  if(patent == 'true'){
    $(id).iCheck('check');
  }else{
    $(id).iCheck('uncheck');
  }
    
  id = "#submit";
  $(id).val("Edit Journal");
  if(pass.journal == ''){
    return errchk(id, '期刊名')
  }

  });
});
