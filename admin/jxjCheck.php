<?php
  include('../conn.php');
  $id = $_POST['id'];
  $i = $_POST['awardid'];
  $idx = 4*$i + 2;
  $status = $_POST['stat'];
  $choice = $_POST['choice'];
  $cardid = $_POST['cardid'];
  $award = $_POST['award'];
  if ( $choice == '通过' && $status[$idx] != 'P' ) {
    $status[$idx] = 'P';
    $sql = "UPDATE journals SET status='{$status}' WHERE id=$id";
    $res=mysql_query($sql);
  }
  if ( $choice == '修改' && $status[$idx] != 'W' ) {
    $status[$idx] = 'W';
    $sql = "UPDATE journals SET status='{$status}' WHERE id=$id";
    $res=mysql_query($sql);
  }

if ( $_POST['up'] == 'T' ) {
  $sql = "SELECT * FROM students WHERE idcard='".mysql_real_escape_string($cardid)."'";
  $res = mysql_query($sql);
  $row = mysql_fetch_row($res);
  $jxjs = explode("|",$row[2]);
  $tmp0 = explode("|",$row[3]);
  $n = count($jxjs);
  $n--;
  $str = "";
  for ( $i=0; $i<$n; $i++ ) {
    if ( $jxjs[$i] == $award ) {
      $m = strlen($tmp0[$i]);
      $m = $m - 1 ;
      $tmp0[$i][$m] = $_POST['pass'];
      $str = $str.$tmp0[$i]."|";
    } else {
      $str = $str.$tmp0[$i]."|";
    }
  }
  $sql = "UPDATE students SET nif='{$str}' WHERE idcard='".mysql_real_escape_string($cardid)."'";
  $res=mysql_query($sql);
}
?>
