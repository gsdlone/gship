<?php
session_start();
include('../conn.php');

$idcard=$_SESSION['cardid'];
if ( $_SESSION['normal'] == "normal" && strlen($idcard) == 32 ) {
} else {
  header("Location: ../index.php");
}
$award = $_POST["x"];
$status = $_POST["y"];
$id = $_POST["id"];

$sql = "UPDATE journals SET award='$award', status='$status' WHERE idcard='$idcard' and id='$id'";
$result=mysql_query($sql,$con);

?>
