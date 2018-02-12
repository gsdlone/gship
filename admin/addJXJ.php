<?php
include('../conn.php');

$jxjname = $_POST["newJXJ"];
$jxjid = $_POST["kind"];
$jxjstatus = 0;
$jxjstatusx= 0;

$sql = "SELECT * FROM jxjkinds WHERE jxjname='".mysql_real_escape_string($jxjname)."'";
$res=mysql_query($sql);

if($row = mysql_fetch_row($res)){
  $ret = -1;
  echo $ret;
} else {
  $sql = "INSERT INTO jxjkinds (jxjname,jxjid,status,statusx) VALUES ('$jxjname','$jxjid','$jxjstatus','$jxjstatusx')";
  $res=mysql_query($sql);
}

?>
