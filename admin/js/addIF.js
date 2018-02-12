$(document).ready(function($){
  $("#btnIF").click(function(){
     $("#addIF").modal();
  });

  $('#import-IF-form').bind('submit', function(e){
    e.preventDefault();
    var formData = new FormData($(this)[0]); 
    $.ajax({
      url: this.action,
      type: this.method,
      data: formData,
      async: false,
      cache: false,
      contentType: false,
      enctype: 'multipart/form-data',
      processData: false,
          success: function(data){
//        if(data != ''){
//          cont = decodeURIComponent(data);
//                    alert(cont);
//        }
        alert('导入成功!');
        location.reload();
      }
    });
    });

  function filechk(str) {
    var pos = str.lastIndexOf(".");
    var lastname = str.substring(pos,str.length)
 
    if (lastname.toLowerCase()!=".xls" && lastname.toLowerCase()!=".xlsx") {
      alert("您上传的文件类型为"+lastname+",必须为.xls,.xlsx类型");
      return false;
    } else {
      return true;
    }
  }

  $('#addIF').find('.modal-footer #IF-confirm').on('click', function(){
    exlname = $('#import-IF-file').val();
    if(!filechk(exlname)){
      return false;
    }

    $('#IF-confirm').attr('disabled', 'disabled');
    $('#IF-display').html('正在处理中...');

    setTimeout("$('#import-IF-form').submit()", 1000);
  });
});
