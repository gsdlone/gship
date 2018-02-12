<?php
include('../conn.php');
for($i=0; $i<=$_POST["ntotal"]; $i++){
  $namex = "ax".$i;
  $namey = "ay".$i;
  $nameid = "id".$i;
  $tmpx = $_POST[$namex];
  $tmpy = $_POST[$namey];
  $id = $_POST[$nameid];
  $sql = "UPDATE jxjkinds SET status=$tmpx, statusx=$tmpy WHERE id=$id";
  $res=mysql_query($sql);
}
?>
