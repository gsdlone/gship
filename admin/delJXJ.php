<?php
include('../conn.php');

$award = $_POST["award"];

$sql = "DELETE FROM jxjkinds WHERE id={$_POST["id"]}";
$res=mysql_query($sql);
?>
