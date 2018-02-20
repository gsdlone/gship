$(document).ready(function(){
function blank(str){
  reg = /^\s+$/;
    if(reg.test(str) || str == ''){
    return true;
    }
    return false;
}

function IdentityCodeValid(code) { 
    var city={11:"北京",12:"天津",13:"河北",14:"山西",15:"内蒙古",21:"辽宁",22:"吉林",23:"黑龙江 ",31:"上海",32:"江苏",33:"浙江",34:"安徽",35:"福建",36:"江西",37:"山东",41:"河南",42:"湖北 ",43:"湖南",44:"广东",45:"广西",46:"海南",50:"重庆",51:"四川",52:"贵州",53:"云南",54:"西藏 ",61:"陕西",62:"甘肃",63:"青海",64:"宁夏",65:"新疆",71:"台湾",81:"香港",82:"澳门",91:"国外 "};
    var tip = "";
    var pass= true;
    
  if (!code || !/^[1-9][0-9]{5}(19[0-9]{2}|200[0-9]|2010)(0[1-9]|1[0-2])(0[1-9]|[12][0-9]|3[01])[0-9]{3}[0-9xX]$/i.test(code)) {
        tip = "身份证号格式错误";
        pass = false;
    }
    
   else if(!city[code.substr(0,2)]){
        tip = "地址编码错误";
        pass = false;
    }
    else{
        //18位身份证需要验证最后一位校验位
        if(code.length == 18){
            code = code.split('');
            //∑(ai×Wi)(mod 11)
            //加权因子
            var factor = [ 7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2 ];
            //校验位
            var parity = [ 1, 0, 'X', 9, 8, 7, 6, 5, 4, 3, 2 ];
            var sum = 0;
            var ai = 0;
            var wi = 0;
            for (var i = 0; i < 17; i++)
            {
                ai = code[i];
                wi = factor[i];
                sum += ai * wi;
            }
            var last = parity[sum % 11];
            if ( code[17] == 'x' ) {
              var tmpx = 'X';
              code[17] = 'X'; 
            } else {
              var tmpx = code[17];
            }
            if(parity[sum % 11] != tmpx){
                tip = "校验位错误";
                pass =false;
            }
        }
    }

  ret = {}
  ret.pass = pass;
  ret.tip  = tip;
    return ret;
}

function regid(idp){
  id = '#reg-' + idp + '-mdl';
  return id;
}

$('#register').find('.modal-footer #confirm').on('click', function(){
  pass = {};
  str = '不能为空！';
  function blkErr(opt){
    alert(opt + str);
  }

  function regidval(idp){
    id  = regid(idp);
    opt = $(id).val();
    if(idp != 'pwd-confirm')
      if(idp == 'password')
        pass[idp] = md5(opt);    
      else
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

  if(blkchk('cardid', '身份证号码')) return;
  else{
    ret = IdentityCodeValid(regidval('cardid'));
    if(!ret.pass){
      alert(ret.tip);
      $(regid('cardid')).focus();
      return;
    }
  }

  if(blkchk('name',       '姓名'    )) return;
  if(blkchk('arp',        'ARP号'   )) return;
  else{
    var reg = /^\d{4,5}$/;
    if(!reg.exec(pass.arp)){
      alert('ARP号为4或5位数字!');
      return;
    }
  }
  if(blkchk('phone',      '手机号'  )) return;
  if(blkchk('telp',       '部门'    )) return;
  if(blkchk('email',      '邮箱'    )) return;
  if(blkchk('skind',      '学生类别')) return;
  else{
    var reg = /^(本所生|联培生|课题组自招生)$/;
    if(!reg.exec(pass.skind)){
      alert('学生类别只能是 本所生、联培生、或课题组自招生!');
      return;
    }
  }
  if(blkchk('major',      '攻读专业')) return;
  if(blkchk('readway',    '培养层次')) return;
  if(blkchk('teacher',    '指导教师')) return;
  if(blkchk('year',       '入学年份')) return;
  else{
    var reg = /^(19|20)[0-9][0-9]$/;
    if(!reg.exec(pass.year)){
      alert('入学年份请输入1900-2099之间的整数!');
      return;
    }
  }
  if(blkchk('password',   '登录密码')) return;
  if(blkchk('pwd-confirm','密码确认')) return;

  if(pass.cardid.substr(-1) == 'x'){
    pass.cardid = pass.cardid.substr(0, 17) + 'X';
  }
  pass.cardid = md5(pass.cardid);

  $.post("register.php", pass, function(data, status){
    if(data == -1){
      alert('该用户已存在！');
      return;
    }else{
      alert('注册成功！请登录。')
    }
    setTimeout('location.reload()', 100);
  });
});

$(regid('pwd-confirm')).focus(function(){
  id = regid('password');
  password = $(id).val();
  if(blank(password)){
    alert('请先输入登录密码！');
        $(id).focus();
    }
});

$(regid('pwd-confirm')).blur(function(){
  id = regid('password');
  password = $(id).val();
    pwd_confirm = $(this).val();

  if(password != pwd_confirm){
    alert('两次密码不一致，请重新输入！');
    }
});

$(regid('year')).blur(function(){
  id = regid('year');
  cardid = $(id).val();
    var reg = /(19|20)[0-9][0-9]/;
    if(!reg.exec(cardid)){
      alert('入学年份请输入1900-2099之间的整数！');
      return;
    }
});
});
