$(document).ready(function($){
$("#upinfo").click(function(){
  $("#register").modal();
  $('#register').find('.modal-footer #upconfirm').on('click', function(){
    pass = {};
    str = '不能为空!';

    function regid(idp){
      id = '#reg-' + idp + '-mdl';
      return id;
    }

    function blkErr(opt){
      alert(opt + str);
    }
  
    function regidval(idp){
      id  = regid(idp);
      opt = $(id).val();
      pass[idp] = opt;    
      return opt;
    }
  
    function blkchk(idp, optstr){
      opt = regidval(idp);
      if(blank(opt)){
        blkErr(optstr);
        $(id).focus();
        return true;
      }
    }

    function blank(str){
      reg = /^\s+$/;
        if(reg.test(str) || str == ''){
        return true;
        }
        return false;
    }
  
    if(blkchk('name',       '姓名'    )) return;
    if(blkchk('phone',      '手机/电话'  )) return;
    if(blkchk('telp',       '组别')) return;
    if(blkchk('email',      '邮箱'    )) return;
    if(blkchk('major',      '攻读专业')) return;
    if(blkchk('readway',    '攻读方式')) return;
    if(blkchk('teacher',    '指导教师')) return;
    if(blkchk('year',       '入学年份')) return;
  
    $.post("upinfo.php", pass, function(data, status){
      location.reload();
    });
  });

});
});
