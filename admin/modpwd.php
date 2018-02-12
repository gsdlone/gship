<?php
  session_start();
  if( $_SESSION['admin'] == "admin" ){
  }else{
    header("Location: ../index.php");
  }
  date_default_timezone_set('Asia/Shanghai');

  include('../conn.php');

$cardid = $_POST['cardid'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE cardid='${cardid}'";
$res = mysql_query($sql);

$ret = -1;
if($row = mysql_fetch_row($res)){
  $sql = "UPDATE users SET password='$password' WHERE cardid='${cardid}'";
  $res = mysql_query($sql);
  $ret = 0;
}

echo $ret;
?>