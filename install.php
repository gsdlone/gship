<?php
if(!file_exists("config/config.php")){
?>    
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<title>学金评审系统设置</title>
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
  <form name="login-form" class="login-form" action="setconfig.php" method="post">
  
    <div class="header">
    <h1>奖学金评审系统设置</h1>
    </div>
  
    <div class="content">
    <input id="institution" name="institution" type="text" class="input" required placeholder="单位名称"/>
    <div class="user-icon"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></div>    
    <input id="dbname" name="dbname" type="text" class="input" required placeholder="数据库名"/>
    <div class="user-icon"><span class="glyphicon glyphicon-hdd" aria-hidden="true"></span></div>
    <input id="dbuser" name="dbuser" type="text" class="input" required placeholder="数据库用户名"/>
    <div class="user-icon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></div>
    <input id="dbpassword" name="dbpassword" type="text" class="input" required placeholder="数据库密码" />
    <div class="user-icon"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span></div>
    <input id="sysuser" name="sysuser" type="text" class="input" required placeholder="管理员"/>
    <div class="user-icon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></div>
    <input id="syspassword" name="syspassword" type="text" class="input" required placeholder="管理员密码" />
    <div class="user-icon"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span></div>
    </div>

    <div class="footer">
    <input type="submit" name="submit" value="提交" class="button" />
    </div>
  </form>
</div>
</body>
</html>
<?php
}else{
    header("Location: index.php");
}
?>