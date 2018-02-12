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
  <title>申请中的奖学金</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="../jquery/1.12.4/jquery.min.js"></script>
  <script src="../bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="js/jxjwait.js"></script>
  <script src="js/icheck.js"></script>
  <script src="js/typeahead.bundle.min.js"></script>
  <script src="js/handlebars.js"></script>
  <script src="js/examples.js"></script>
  <link href="skins/all.css" rel="stylesheet">
  <link rel="stylesheet" href="css/examples.css">
  <link rel="stylesheet" href="css/custom3.css">
</head>
<body>
<div class="container-fluid sd1" style="margin-top:10px">
 <table class='table table-bordered table-condensed table-hover'>
   <thead>
   <th colspan=10 class='rowTitle' style="background: #dcf0d6;">申请中的奖学金</th>
   </thead>
   <thead>
   <th>编号</th> <th>刊物</th> <th>标题</th> <th>DOI</th> <th>作者</th> <th>第一单位</th> <th>共同一作</th> <th>权重</th> <th>影响因子</th> <th>状态</th>
   </thead>
   <tbody id='mtb'>
   </tbody>
 </table>
</div>
 <?php
   include "../conn.php";
   $sql = "SELECT id,journal,title,doi,nauthors,seq,ifactor,weight,coaffi,coauthor,award,status FROM journals WHERE idcard='".mysql_real_escape_string($_SESSION['cardid'])."'";
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
     $tmpx = array();
     for ( $i=0; $i<$n; $i++ ) {
       if ( strpos($y[$i], 'T') == false ) { // flag != T
         $flag++;
         $tmp[$flag] = $x[$i];
         $tmpx0 = explode(".",$y[$i]);
         $tmpx[$flag] = $tmpx0[1];
       }
     }
     if ( $flag > 0 ) {
       $ntotal++;
       $idx = "t".$ntotal;
       /////////////////////// table contents
       echo "<div id=$idx>";
       echo "<p id='{$idx}x2' style='display:none'>{$row['journal']}</p>";
       echo "<p id='{$idx}x3' style='display:none'>{$row['title']}</p>";
       echo "<p id='{$idx}x4' style='display:none'><a href='https://doi.org/{$row['doi']}' target='_blank'>{$row['doi']}</a></p>";
       echo "<p id='{$idx}x5' style='display:none'>{$row['seq']}/{$row['nauthors']}</p>";
       if ( $row['coaffi'] == "true" ) {
         echo "<p id='{$idx}x6' style='display:none'>是</p>";
       } else if ( $row['coaffi'] == "false" ) {
         echo "<p id='{$idx}x6' style='display:none'>否</p>";
       }
       if ( $row['coauthor'] == "true" ) {
         echo "<p id='{$idx}x7' style='display:none'>是</p>";
       } else if ( $row['coauthor'] == "false" ) {
         echo "<p id='{$idx}x7' style='display:none'>否</p>";
       }
       echo "<p id='{$idx}x8' style='display:none'>{$row['weight']}</p>";
       echo "<p id='{$idx}x9' style='display:none'>{$row['ifactor']}</p>";
       echo "<p id='{$idx}x10' style='display:none'>{$row['id']}</p>";
       echo "</div>";
       /////////////////////// table contents
       echo "<p id='{$idx}n' style='display:none'>{$flag}</p>";
       for ( $j=1; $j<=$flag; $j++ ) {
         $idx = "x".$ntotal."y".$j;
         $idy = "ax".$ntotal."y".$j;
         echo "<p id='{$idx}' style='display:none'>{$tmp[$j]}</p>";
         echo "<p id='{$idy}' style='display:none'>{$tmpx[$j]}</p>";
       }
     }
   }
   echo "<p id='ntotal' style='display:none'>{$ntotal}</p>";
 ?>
<?php
  include_once('addPaperModal.php');
?>
</body>
</html>
