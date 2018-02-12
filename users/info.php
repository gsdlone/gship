<?php
  $idcard=$_SESSION['cardid'];
  if ( $_SESSION['normal'] == "normal" && strlen($idcard) == 32 ) {
  } else {
    header("Location: ../index.php");
  }
  echo "<p style='display:none' id='idselect'></p>";
  $sql = "SELECT id,award,nif FROM students WHERE idcard='".mysql_real_escape_string($_SESSION['cardid'])."'";
  $result=mysql_query($sql,$con);
  if(mysql_num_rows($result)>0){
    while($row=mysql_fetch_assoc($result)){
      echo "<p style='display:none' id='myjxjid'>{$row['id']}</p>";
      echo "<p style='display:none' id='myjxjs'>{$row['award']}</p>";
      echo "<p style='display:none' id='myjxjsx'>{$row['nif']}</p>";
    }
   } else {
      echo "<p style='display:none' id='myjxjid'>F</p>";
      echo "<p style='display:none' id='myjxjs'></p>";
      echo "<p style='display:none' id='myjxjsx'></p>";
   }
?>
