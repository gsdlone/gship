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
  
    if(blkchk('name',       '姓名'     )) return;
    if(blkchk('arp',        'ARP号'    )) return;
    else{
      var reg = /^\d{4,5}$/;
      if(!reg.exec(pass.arp)){
        alert('ARP号为4或5位数字!');
        return;
      }
    }
    if(blkchk('phone',      '手机/电话')) return;
    if(blkchk('telp',       '部门'     )) return;
    if(blkchk('email',      '邮箱'     )) return;
    if(blkchk('skind',      '学生类别' )) return;
    else{
      var reg = /^(本所生|联培生|课题组自招生)$/;
      if(!reg.exec(pass.skind)){
        alert('学生类别只能是 本所生、联培生、或课题组自招生!');
        return;
      }
    }
    if(blkchk('major',      '攻读专业' )) return;
    if(blkchk('readway',    '培养层次' )) return;
    else{
      var reg = /^(硕士|博士)$/;
      if(!reg.exec(pass.readway)){
        alert('培养层次只能是 硕士、博士!');
        return;
      }
    }
    if(blkchk('teacher',    '指导教师' )) return;
    if(blkchk('year',       '入学年份' )) return;
    else{
      var reg = /^(19|20)[0-9][0-9]$/;
      if(!reg.exec(pass.year)){
        alert('入学年份请输入1900-2099之间的整数!');
        return;
      }
    }
  
    $.post("upinfo.php", pass, function(data, status){
      location.reload();
    });
  });

});
});
