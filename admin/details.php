<?php
  session_start();
  if( $_SESSION['admin'] == "admin" ){
  }else{
    header("Location: ../index.php");
  }
  date_default_timezone_set('Asia/Shanghai');
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <title>文章具体信息</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="../jquery/1.12.4/jquery.min.js"></script>
  <script src="../bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="js/jxjCheck.js"></script>
  <link rel="stylesheet" href="css/custom3.css">
</head>
<body>
<div class="container-fluid" style="margin-top:10px">
 <table class='table table-bordered table-condensed table-hover'>
 <thead>
 <th style='background: #dcf0d6;' colspan=12><span class='rowTitle'>文 章 审 核</span></th>
 </thead>
 <?php
   $award = $_POST["award"];
   echo "<p id='award' style='display:none'>{$award}</p>";
   echo "<p id='cardid' style='display:none'>{$_POST['cardid']}</p>";
   include "../conn.php";
   $sql = "SELECT id,journal,title,doi,nauthors,seq,ifactor,weight,coaffi,coauthor,award,status FROM journals WHERE idcard='".mysql_real_escape_string($_POST['cardid'])."'";
   $result=mysql_query($sql);
   $total=0.0;
   $count = 0;
   $ntp = 0;
   echo "
     <thead>
     <th>编号</th>
     <th>刊物</th>
     <th>标题</th>
     <th>DOI</th>
     <th>作者</th>
     <th>第一单位</th>
     <th>共同一作</th>
     <th>权重</th>
     <th>分区分数</th>
     <th>状态</th>
     <th style='min-width:102px'>审核</th>
     </thead>
   ";
   while($row=mysql_fetch_assoc($result)){
     $x = explode("|",$row["award"]);
     $y = explode("|",$row["status"]);
     $n = count($x) - 1;
     for ( $i=0; $i<$n; $i++ ) {
       if( $x[$i] == $award ) {
         $stat = explode(".",$y[$i]);
         $total=$total+$row['ifactor']*$row['weight'];
         $count++;
         $n=0;
         echo "<tr>";
         echo "<td>{$count}</td>";
         $idx = 'stat'.$row['id'];
         $idy = 'award'.$row['id'];
         echo "<p id=$idx style='display:none'>{$row['status']}</p>";
         echo "<p id=$idy style='display:none'>{$i}</p>";
         echo "<td>{$row['journal']}</td>";
         echo "<td>{$row['title']}</td>";
         echo "<td><a href='https://doi.org/{$row['doi']}' target='_blank'>{$row['doi']}</a></td>";
         echo "<td>{$row['seq']}/{$row['nauthors']}</td>";
         if ( $row['coaffi'] == "true" ) {
           echo "<td>是</td>";
         } else if ( $row['coaffi'] == "false" ) {
           echo "<td>否</td>";
         }
         if ( $row['coauthor'] == "true" ) {
           echo "<td>是</td>";
         } else if ( $row['coauthor'] == "false" ) {
           echo "<td>否</td>";
         }
         echo "<td>{$row['weight']}</td>";
         echo "<td>{$row['ifactor']}</td>";
         $idx = 'check'.$row['id'];
         if ( $stat[1] == 'F') {
           echo "<td id=$idx><span style='color:red'>待审核</span></td>";
         } else if ( $stat[1] == 'W' ) {
           echo "<td id=$idx><span style='color:orange'>待修改</span></td>";
         } else if ( $stat[1] == 'R' ) {
           echo "<td id=$idx><span style='color:blue'>已修改</span></td>";
         } else if ( $stat[1] == 'P' ) {
           echo "<td id=$idx><span style='color:green'>已审核</span></td>";
           $ntp++;
         }
         $idx = 'pl'.$row['id'];
         $idy = 'rl'.$row['id'];
         echo "<td>
         <div class='btn-group'>
           <button type='button' id=$idx class='btn btn-check btn-sm btn-default'>通过</button>
           <button type='button' id=$idy class='btn btn-check btn-sm btn-info'>修改</button>
         </div>
         </td>";
         echo "</tr>";
///////////////////////// main if
       }
     }
   }
     echo "<tr>";
     echo " 
       <td colspan=11>
         加权后总分区分数：<span>$total</span>
       </td>";
     echo "</tr>";
     echo "<p id='ntr' style='display:none'>{$count}</p>";
     echo "<p id='ntp' style='display:none'>{$ntp}</p>";
 ?>
 </table>
</div>
</body>
</html>
