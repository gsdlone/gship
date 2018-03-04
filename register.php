<?php
include_once("conn.php");

$cardid   = $_POST["cardid"];
$name     = $_POST["name"];
$arp      = $_POST["arp"];
$phone    = $_POST["phone"];
$telp     = $_POST["telp"];
$email    = $_POST["email"];
$skind    = $_POST["skind"];
$major    = $_POST["major"];
$readway  = $_POST["readway"];
$teacher  = $_POST["teacher"];
$year     = $_POST["year"];
$password = $_POST["password"];
$national = "无";

if($cardid != ''){
  $sql = "SELECT * FROM users WHERE cardid='${cardid}'";
  $res = mysql_query($sql);

  $ret = 0;
  if(!$row = mysql_fetch_row($res)){
    $sql = "INSERT INTO users (cardid,name,phone,telp,email,major,readway,teacher,year,password,arp,skind,national) 
VALUES ('${cardid}', '${name}', '${phone}', '${telp}', '${email}', '${major}', '${readway}', '${teacher}', '${year}', '${password}', '${arp}', '${skind}', '${national}')";
    $res = mysql_query($sql);
  }else{
    $ret = -1;
  }
  echo $ret;
}else{
  echo "没有权限！";
}
?>
