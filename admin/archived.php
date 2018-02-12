<?php
session_start();
if(!isset($_SESSION['admin'])){
	header('Content-Type:text/html; charset=utf-8');
	echo "错误!没有权限!";
	exit(0);
}
  date_default_timezone_set('Asia/Shanghai');
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <title>已入档奖学金</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="../jquery/1.12.4/jquery.min.js"></script>
  <script src="../bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="js/jxjstudents.js"></script>
  <link rel="stylesheet" href="css/custom3.css">
</head>
<body>
<div class='container-fluid' style='margin-top:10px'>
 <table class='table table-bordered table-condensed table-hover'>
 <thead>
 <th style='background: #dcf0d6;' colspan=5><span class='rowTitle'>历年奖学金</span></th>
 </thead>
<?php
  include('../conn.php');

  $sql = "SELECT DISTINCT award FROM archived";
  $res=mysql_query($sql);
  $n = 0;
  $m = 0;
  while($row=mysql_fetch_row($res)){
    $n++;
    $m++;
    $id1 = "a".$n;
    $id2 = "b".$n;
    $id3 = "c".$n;
    if ( $m == 1 ) {
    echo "<tr>
          <td>
            <a id='{$id1}' class='award'>{$row[0]}</a>
            <form action='jxjstudents.php' method='POST' target='_blank' id='{$id3}'>
              <input type='hidden' name='award' id='{$id2}'/>
            </form>
          </td>";
    } else if ( $m < 5 ) {
    echo " <td>
            <a id='{$id1}' class='award'>{$row[0]}</a>
            <form action='jxjstudents.php' method='POST' target='_blank' id='{$id3}'>
              <input type='hidden' name='award' id='{$id2}'/>
            </form>
          </td>";
    } else if ( $m == 5 ) {
      $m = 0;
    echo " <td>
            <a id='{$id1}' class='award'>{$row[0]}</a>
            <form action='jxjstudents.php' method='POST' target='_blank' id='{$id3}'>
              <input type='hidden' name='award' id='{$id2}'/>
            </form>
          </td>
          </tr>";
    }
  }
  echo "</tr>";
?>
</table></div>
</body>
</html>
