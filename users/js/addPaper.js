$(document).ready(function($){
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
  $(idradio).on('ifChecked', function(event){
      $("#totalnumlabel").show();
      $("#ncoauthor").show();
  });      
  $(idradio).on('ifUnchecked', function(event){
      $("#totalnumlabel").hide();
      $("#ncoauthor").val('1');      
      $("#ncoauthor").hide();
  });      

  idradio = "input[id='supervisor']";
  $(idradio).iCheck({
    checkboxClass: 'icheckbox_square-aero',
    increaseArea: '20%'
  });

  idradio = "input[id='patent']";
  $(idradio).iCheck({
    checkboxClass: 'icheckbox_square-aero',
    increaseArea: '20%'
  });
    
  $("#btn_add").click(function(){
    $("#addpaper").modal();

    $("#journal").val('');
    $("#title").val('');
    $("#doi").val('');
    $("#nauthors").val('');
    $("#seq").val('');
    $('#coaffi').iCheck('uncheck');
    $('#coauthor').iCheck('uncheck');
    $('#supervisor').iCheck('uncheck');
    $('#patent').iCheck('uncheck');
    $("#ncoauthor").val('1');
    $("#totalnumlabel").hide();
    $("#ncoauthor").hide();

    $("#submit").val("Add Journal");
  });

  function errchk(id, str){
    blank = '不能为空';
    alert(str + blank);
    $(id).focus();
    return false;
  }

  $("#submit").click(function(){
    pass = {};

    id = "#paper-id";
    pass.id = $(id).val();

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

    id = '#ncoauthor'
    pass.ncoauthor = $(id).val();
    if(pass.ncoauthor == ''){
      return errchk(id, '共同一作作者总数');
    }
    if(!reg.test(pass.ncoauthor)){
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

    var tmpseq = parseFloat(pass.seq);
    var tmpnauthors = parseFloat(pass.nauthors);
    if(tmpseq > tmpnauthors){
      alert('署名顺序不应大于作者总数');
      return false;
    }

    pass.coaffi   = $('#coaffi').is(':checked');
    pass.coauthor = $('#coauthor').is(':checked');
    pass.supervisor = $('#supervisor').is(':checked');
    pass.patent     = $('#patent').is(':checked');

    if(pass.coauthor && pass.seq > pass.ncoauthor){
        alert('在共同一作情况下，署名顺序不应大于共同一作总数');
        return false;
    }
      
    pass.submit = $("#submit").val();

    action = "addPaper.php";
    $.post(action, pass, function(data){
      if(data == -1){
        alert('DOI为\''+pass.doi+'\'的文章重复，请检查。')
      }else{
        location.reload();
      }
    });
  });
});
