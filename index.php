<?php
if(file_exists("json/config.php")){
  include("conn.php");
  date_default_timezone_set('Asia/Shanghai');
}else{
    header("Location: install.php");
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <title><?=${sitename}?>奖学金评审系统</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
  <script src="jquery/1.12.4/jquery.min.js"></script>
  <script src="bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="js/loginCheck.js"></script>
  <script src="js/md5.js"></script>
  <link href="css/login.css" rel="stylesheet">
</head>

<body>
<div class="container-fluid">
<div id="wrapper">
  <form name="login-form" class="login-form" action="login.php" method="post">
  
    <div class="header">
    <h1>奖学金评审系统</h1>
    <span><?=${sitename}?></span>
    </div>
  
    <div class="content">
    <input id="cardid" name="cardid" type="text" class="input username" required placeholder="身份证号"/>
    <div class="user-icon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></div>
    <input id="password" name="password" type="password" class="input password" required placeholder="密码" />
    <div class="pass-icon"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span></div>
    </div>

    <div class="footer">
    <input type="submit" name="submit" value="登录" class="button" />
    <p class="register" data-toggle="modal" data-target="#register">注册</p>
    <p class="contact" data-container="body" data-toggle="popover" data-placement="top" data-content="联系管理员: ">忘记密码?</p>
    </div>
  </form>
</div>
<?php include_once("regModal.php"); ?>
<?php //include_once("footer.php"); ?>
<script>
$(function () {
  $('[data-toggle="popover"]').popover()
})
</script>
</body>
</html>
