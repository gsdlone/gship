<div id="custom-bootstrap-menu" class="navbar navbar-default navbar-fixed-top" role="navigation"> 
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
  </div>
  <div class="collapse navbar-collapse" id="myNavbar">
    <ul class="nav navbar-nav">
      <li><a class='lip' id="upinfo"  data-toggle="tooltip" data-placement="bottom" title="查看或修改个人信息">个人信息</a></li>
      <li><a href="jxjwait.php" id="jxjwait" target="_blank" data-toggle="tooltip" data-placement="bottom" title="查看奖学金申请状态">申请状态</a></li>
      <li><a href="myjxj.php" id="myjxj" target="_blank" data-toggle="tooltip" data-placement="bottom" title="查看已获得的奖学金">我的奖学金</a></li>
    </ul>
    <div class="navbar-right">
      <?php
        include "../conn.php";
        $sql = "SELECT name FROM users WHERE cardid='".mysql_real_escape_string($_SESSION['cardid'])."'"; 
        $res = mysql_query($sql);
        $row= mysql_fetch_row($res);
        echo "<ul class='nav navbar-nav'>
          <li style='margin-top:14px; padding:0px 0px 0px 15px'>用户：$row[0]&nbsp;&nbsp;&nbsp;&nbsp;</li>
          <li><a href='exit.php'>退出</a></li>
        </ul>";
      ?>
    </div>
  </div>
</div>
