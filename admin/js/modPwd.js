$(document).ready(function($){
  $("#modPasswd").click(function(){
     $("#modPwd").modal();
  });

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

  $('#modPwd').find('.modal-footer #mod-confirm').on('click', function(){

  pass = {};
  str = '不能为空！';
  function blkErr(opt){
    alert(opt + str);
  }

	var id = '#mdl-cardid';
	var cardid = $(id).val();
    if(blank(cardid)){
      blkErr('身份证号');
      $(id).focus();
      return;
    }else{
      var ret = IdentityCodeValid(cardid);
      if(!ret.pass){
        alert(ret.tip);
        $(id).focus();
        return;
      }
	}

    if(cardid.substr(-1) == 'x'){
      cardid = cardid.substr(0, 17) + 'X';
    }
    pass.cardid = md5(cardid);


	var id = '#mdl-password';
	var pwd = $(id).val();
    if(blank(pwd)){
      blkErr('帐号密码');
      $(id).focus();
      return;
	}

	var id = '#mdl-pwd-confirm';
	var cfm = $(id).val();
    if(blank(cfm)){
      blkErr('确认密码');
      $(id).focus();
      return;
	}else{
	  if(cfm != pwd){
		alert('两次密码不一致!');
		return;
	  }
	}

	pass.password = md5(pwd);

	$.post("modpwd.php", pass, function(data){
		if(data == -1){
			alert('所输入帐号不存在！请检查输入。');
		}else{
			alert('修改成功!');
			location.reload();
		}
	});
  });
});
