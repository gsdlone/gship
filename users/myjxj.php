<?php
  session_start();
  if( $_SESSION['normal'] == "normal" ){
  }else{
    header("Location: ../index.php");
  }
  date_default_timezone_set('Asia/Shanghai');
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <title>已获得的奖学金</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/custom3.css">
  <script src="../jquery/1.12.4/jquery.min.js"></script>
  <script src="../bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="js/myjxj.js"></script>
</head>
<body>
<div class="container-fluid sd1" style="margin-top:10px">
 <table class='table table-bordered table-condensed table-hover'>
   <thead>
   <th colspan=9 class='rowTitle' style="background: #dcf0d6;">我的奖学金</th>
   </thead>
   <thead>
   <th>编号</th> <th>刊物</th> <th>标题</th> <th>DOI</th> <th>作者</th> <th>第一单位</th> <th>共同一作</th> <th>权重</th> <th>分区分数</th>
   </thead>
   <tbody id='mtb'>
   </tbody>
 </table>
</div>
 <?php
   include "../conn.php";
   $sql = "SELECT id,journal,title,doi,nauthors,seq,ifactor,weight,coaffi,coauthor,award,status,ncoauthor,mycoauthor,supervisor FROM journals WHERE idcard='".mysql_real_escape_string($_SESSION['cardid'])."'";
   $result=mysql_query($sql);
   $output = array();
   $nj = 0;
   while ( $row=mysql_fetch_assoc($result) ) {
     $nj++;
     $output[$nj] = $row;
   }
   $ntotal=0;
   for ( $ix=1; $ix<=$nj; $ix++ ) {
     $row = $output[$ix];
     $x = explode("|",$row["award"]);
     $y = explode("|",$row["status"]);
     $n = count($x) - 1;
     $flag = 0;
     $tmp = array();
     for ( $i=0; $i<$n; $i++ ) {
       if ( strpos($y[$i], 'T') != false ) { // flag is T
         $flag++;
         $tmp[$flag] = $x[$i];
       }
     }
     if ( $flag > 0 ) {
       $ntotal++;
       $idx = "t".$ntotal;
       /////////////////////// table contents
       echo "<div id=$idx>";
       echo "<p id='{$idx}2' style='display:none'>{$row['journal']}</p>";
       echo "<p id='{$idx}3' style='display:none'>{$row['title']}</p>";
       echo "<p id='{$idx}4' style='display:none'><a href='https://doi.org/{$row['doi']}' target='_blank'>{$row['doi']}</a></p>";
       echo "<p id='{$idx}5' style='display:none'>{$row['seq']}/{$row['nauthors']}</p>";
       if ( $row['coaffi'] == "true" ) {
         echo "<p id='{$idx}6' style='display:none'>是</p>";
       } else if ( $row['coaffi'] == "false" ) {
         echo "<p id='{$idx}6' style='display:none'>否</p>";
       }
       if ( $row['coauthor'] == "true" ) {
         echo "<p id='{$idx}7' style='display:none'>是</p>";
       } else if ( $row['coauthor'] == "false" ) {
         echo "<p id='{$idx}7' style='display:none'>否</p>";
       }
       echo "<p id='{$idx}8' style='display:none'>{$row['weight']}</p>";
       echo "<p id='{$idx}9' style='display:none'>{$row['ifactor']}</p>";
       echo "<p id='{$idx}10' style='display:none'>{$row['ncoauthor']}</p>";
       echo "<p id='{$idx}11' style='display:none'>{$row['mycoauthor']}</p>";
       echo "<p id='{$idx}12' style='display:none'>{$row['supervisor']}</p>";
       echo "</div>";
       /////////////////////// table contents
       echo "<p id='{$idx}n' style='display:none'>{$flag}</p>";
       for ( $j=1; $j<=$flag; $j++ ) {
         $idx = "x".$ntotal."y".$j;
         echo "<p id='{$idx}' style='display:none'>{$tmp[$j]}</p>";
       }
     }
   }
   echo "<p id='ntotal' style='display:none'>{$ntotal}</p>";
 ?>
</body>
</html>
