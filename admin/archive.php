<?php
  session_start();
  if( $_SESSION['admin'] == "admin" ){
  }else{
    header("Location: ../index.php");
  }
  date_default_timezone_set('Asia/Shanghai');

  include('../conn.php');
  $idcard = $_POST['idcard'];
  $award = $_POST['award'];
  $ifactor = $_POST['ifactor'];
  $choice = $_POST['stat'];

  if ( $choice == 'true' ) {
    $sql = "INSERT INTO archived (cardid,award,ifactor) VALUES ('$idcard','$award','$ifactor')";
    $res=mysql_query($sql);
  }

  $sql = "SELECT readway FROM users WHERE cardid='".mysql_real_escape_string($idcard)."'";
  $res=mysql_query($sql);
  while($row=mysql_fetch_row($res)){
    $readway = $row[0];
  }

  $sql = "SELECT id,award,status FROM journals WHERE idcard='".mysql_real_escape_string($idcard)."'";
  $res=mysql_query($sql);
  while($row=mysql_fetch_row($res)){
    // loop through papers
    $statx = "";
    $awardx = "";
    $jxjs = explode("|",$row[1]);
    $stat = explode("|",$row[2]); // 如 0.F|1.T|
    $n = count($jxjs);
    $n--;
    for ( $i=0; $i<$n; $i++ ) {
      if ( $jxjs[$i] == $award ) { // 若为将要入档的奖学金
        if ( $choice == 'true' ) { // 若获得该奖学金,将状态改为T
          $x00 = explode(".",$stat[$i]); // 如 0.F
          $x = $x00[0]; // 所申请的奖学金level
          $statx = $statx.$x.".T|";
          $awardx = $awardx.$jxjs[$i]."|";
          if ( $x == "0" ) { // 若为国家奖学金
            $sql = "UPDATE users SET national='{$readway}' WHERE cardid='".mysql_real_escape_string($idcard)."'";
            $result=mysql_query($sql);
          }
        }
      } else {
        $statx = $statx.$stat[$i]."|"; // 保留其他奖学金选项
        $awardx = $awardx.$jxjs[$i]."|";
      }
    }
    $sql = "UPDATE journals SET award='{$awardx}', status='{$statx}' WHERE id=$row[0] and idcard='".mysql_real_escape_string($idcard)."'";
    $result=mysql_query($sql);
    // loop through papers
  }

  $tmp = 1;
  $sql = "UPDATE jxjkinds SET statusx=$tmp WHERE jxjname='{$award}'"; // 将该奖学金设置为 入档 状态
  $result=mysql_query($sql);

  $sql = "SELECT * FROM students WHERE idcard='".mysql_real_escape_string($idcard)."'";
  $res=mysql_query($sql);
  while($row=mysql_fetch_row($res)){
    $statx = "";
    $awardx = "";
    $jxjs = explode("|",$row[2]);
    $stat = explode("|",$row[3]);
    $n = count($jxjs);
    $n--;
    for ( $i=0; $i<$n; $i++ ) {
      if ( $jxjs[$i] != $award ) {
        $statx = $statx.$stat[$i]."|"; // 保留其他奖学金选项
        $awardx = $awardx.$jxjs[$i]."|";
      }
    }
  }
  $sql = "UPDATE students SET award='{$awardx}', nif='{$statx}' WHERE idcard='".mysql_real_escape_string($idcard)."'";
  $res=mysql_query($sql);
?>
