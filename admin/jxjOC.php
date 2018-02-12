<?php
  include('../conn.php');
  $id = $_POST["id"];
  $stat = $_POST["stat"];
  if ( $stat == "开启" ) {
    $tmpx = 0;
  } else if ( $stat == "关闭" ) {
    $tmpx = 1;
  }
  $sql = "UPDATE jxjkinds SET status=$tmpx WHERE id=$id";
  $res=mysql_query($sql);
?>
