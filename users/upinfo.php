<?php
session_start();
include_once("../conn.php");

$idcard= $_SESSION['cardid'];
if ( $_SESSION['normal'] == "normal" && strlen($idcard) == 32 ) {
} else {
  header("Location: ../index.php");
}
$name    = $_POST["name"];
$arp     = $_POST["arp"];
$phone   = $_POST["phone"];
$telp    = $_POST["telp"];
$email   = $_POST["email"];
$skind   = $_POST["skind"];
$major   = $_POST["major"];
$readway = $_POST["readway"];
$teacher = $_POST["teacher"];
$year    = $_POST["year"];

$sql = "UPDATE users SET name='$name', arp='$arp', phone='$phone', telp='$telp', email='$email', skind='$skind', major='$major', readway='$readway', teacher='$teacher', year='$year' WHERE cardid='$idcard'";
$result=mysql_query($sql);

?>
