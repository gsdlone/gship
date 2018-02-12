<?php
include "../conn.php";
$sql = "DELETE FROM journals WHERE id={$_POST["id"]}";
$result=mysql_query($sql);
?>
