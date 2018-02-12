<?php
  session_start();
  if( $_SESSION['admin'] == "admin" ){
  }else{
    header("Location: ../index.php");
  }
  date_default_timezone_set('Asia/Shanghai');
  include "../conn.php";
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <title>大连化学物研究所奖学金评审系统</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="../jquery/1.12.4/jquery.min.js"></script>
  <script src="../bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>

<table class="table table-striped">
	<thead>
		<th>序号</th>
		<th>杂志名</th>
		<th>影响因子</th>
	</thead>
	<tbody>
<?php
$sql = "SELECT * FROM impact ORDER BY ID";
$res = mysql_query($sql);
while($row = mysql_fetch_row($res)){
?>
		<tr>
			<td><?=$row[0]?></td>
			<td><?=$row[1]?></td>
			<td><?=$row[2]?></td>
		</tr>
<?php
}
?>
	</tbody>
</table>
</body>
</html>