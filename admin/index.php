<?php
  session_start();
  if( $_SESSION['admin'] == "admin" ){
    include("../conn.php");
  }else{
    header("Location: ../index.php");
  }
  date_default_timezone_set('Asia/Shanghai');
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <title><?=${sitename}?>奖学金评审系统</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="../jquery/1.12.4/jquery.min.js"></script>
  <script src="../bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="../js/md5.js"></script>
  <script src="js/addJXJ.js"></script>
  <script src="js/delJXJ.js"></script>
  <script src="js/addIF.js"></script>
  <script src="js/modPwd.js"></script>
  <script src="js/upJXJStatus.js"></script>
  <script src="js/jxjOC.js"></script>
  <script src="js/archive.js"></script>
  <script src="js/dropdown.js"></script>
  <script src="js/details.js"></script>
  <link rel="stylesheet" href="css/custom.css">
  <link rel="stylesheet" href="css/outline.css">
</head>
<body>
<!-- navbar -->
<nav class="navbar navbar-default navbar-fixed-top">
  <?php include_once('navbar.php'); ?>
</nav>

<?php
  $sql = "SELECT * FROM jxjkinds";
  $res = mysql_query($sql);
  $sql = "SELECT * FROM students";
  $resx = mysql_query($sql);
  $ntotal = 0;
  $nactive = 0;
  $np = 0;
  $ap = array(); // students
  while($rowx=mysql_fetch_row($resx)){
    $np++;
    $ap[$np] = $rowx;
  }
  echo "<div class='div1 container-fluid box-shadow'>";
  while($row=mysql_fetch_row($res)){
    $ntotal++;
    $id=$row[2];
    if($row[3]==0){
      $stat = "开启";
    }elseif($row[3]==1){
      $stat = "关闭";
    }
    if($row[4]==0){
      $nactive++;
      $statx = "未入档";
      $idown = "down".$nactive; // id of table
      $idt = "tab".$nactive; // id of table
      $idx = "t".$nactive; // id of table
      $ids = "s".$nactive; // id of award
      $idb = "b".$nactive; // id of buttun for archive
      $ido = "o".$row[0];
	  $ide = "e".$nactive;
      echo "<p id='$idx' style='display:none'>{$nactive}. {$row[1]}</p>";
      if ( $nactive == 1 ) {
        echo "<table id='{$idt}' class='table table-bordered table-striped table-condensed table-hover'>";
      } else {
        echo "<table id='{$idt}' style='display:none' class='table table-bordered table-striped table-condensed table-hover'>";
      }
      echo "<thead>";
      echo "<th style='background: #dcf0d6;' colspan=15><span id='$ids' class='rowTitle'>{$row[1]}</span>";
      echo "<div class='btn-group' style='float:left'>";
      echo "<button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><span id='btnJXJDown'>奖学金</span><span>&nbsp;&nbsp;</span><span class='caret'></span></button>";
      echo "<ul class='dropdown-menu jxjDown'></ul>";
      echo "</div>";

      echo "<div class='btn-group' style='float:right'>";
      echo "<button id='{$idb}' type='button' class='btn btn-default btn-small btn-archive'>入档</button>";
      if ( $row[3] == 0 ) {
        echo "<button id='{$ido}' type='button' class='btn btn-success btn-small btn-oc'>关闭</button>";
      } else if ( $row[3] == 1 ) {
        echo "<button id='{$ido}' type='button' class='btn btn-warning btn-small btn-oc'>开启</button>";
      }
      echo "<a id='{$ide}' type='button' class='btn btn-default btn-small' href='savexl.php?jxjname={$row[1]}' type='submit'>导出</a>";
	  echo "</div></th>";
      echo "</thead>";
      echo "<thead>";
      echo "<th>编号</th>";
      echo "<th>入档</th>";
      echo "<th>姓名</th>";
      echo "<th>联系方式</th>";
      echo "<th>邮箱</th>";
      echo "<th>组别</th>";
      echo "<th>入学年份</th>";
      echo "<th>攻读类别</th>";
      echo "<th>专业</th>";
      echo "<th>指导教师</th>";
      echo "<th>文章总数</th>";
      echo "<th>一作影响因子</th>";
      echo "<th>一作最高因子</th>";
      echo "<th>影响因子</th>";
      echo "<th>状态</th>";
      echo "</thead>";
      $nl = 0;
      for ( $j=1; $j<=$np; $j++ ) {
        $jxjs = explode("|",$ap[$j][2]);
        $nif = explode("|",$ap[$j][3]);
        $n = count($jxjs) - 1;
        for ( $i=0; $i<$n; $i++ ) {
          if( $jxjs[$i] == $row[1] ) {
////////////////////////
$sql = "SELECT ifactor,weight,award FROM journals WHERE idcard='".mysql_real_escape_string($ap[$j][1])."'";
$resz = mysql_query($sql);
$totalpaper = 0;
$totalif = 0.0;
$firstnum = 0;
$firstif  = 0.0;
$firstmax = 0.0;
while($rowz=mysql_fetch_assoc($resz)){
  $x = explode("|",$rowz["award"]);
  $ntmp = count($x) - 1;
  for ( $k=0; $k<$ntmp; $k++ ) {
    if( $x[$k] == $row[1] ) {
      $totalif = $totalif + $rowz['ifactor']*$rowz['weight'];
      $totalpaper++;
	  if($rowz['weight'] == 1){
		$firstnum++;
        $firstif = $firstif + $rowz['ifactor']*$rowz['weight'];		
	
		if($rowz['ifactor'] > $firstmax){
		  $firstmax = $rowz['ifactor'];
		}
	  }
    }
  }
}
////////////////////////
            $sql = "SELECT * FROM users WHERE cardid='".mysql_real_escape_string($ap[$j][1])."'";
            $resy = mysql_query($sql);
            $rowy=mysql_fetch_row($resy);
            $nl++;
            $idy = $idb."x".$nl;
            $idz = $idb."y".$nl;
            $idif = $idb."z".$nl;
            $idnp = $idb."p".$nl;
            $idhref = $ids."|".$idy;
            $idf1 = $ids."f";
            $idf2 = $ids."a";
            $idf3 = $ids."c";
            echo "<tr>";
            echo "<td>{$nl}</td>";
            echo "<td><input id='$idz' type='checkbox' unchecked style='display:inline'/></td>";
            echo "<td> <a id='{$idhref}' class='hrefDetails lip'>{$rowy[2]}</a>
              <form action='details.php' method='POST' target='_blank' id='{$idf1}'>
                <input type='hidden' name='award' id='{$idf2}'/>
                <input type='hidden' name='cardid' id='{$idf3}'/>
              </form>
            </td>"; // name
            echo "<td>{$rowy[3]}</td>"; // phone
            echo "<td>{$rowy[5]}</td>"; // email
            echo "<td>{$rowy[4]}</td>"; // telp used as group name
            echo "<td>{$rowy[9]}</td>"; // year
            echo "<td>{$rowy[7]}</td>"; // kind
            echo "<td>{$rowy[6]}</td>"; // major
            echo "<td>{$rowy[8]}</td>"; // teacher
            $nifx = explode("x",$nif[$i]);
            $totalif = number_format((float) $totalif, 3, '.', ''); 
            //echo "<td id='{$idnp}'>{$nifx[0]}</td>"; // number of papers
            //echo "<td id='{$idif}'>{$nifx[1]}</td>"; // total if
			$firstif = sprintf("%.3f", $firstif);
            echo "<td id='{$idnp}'>{$totalpaper}</td>"; // number of papers
            echo "<td>{$firstif}/{$firstnum}</td>"; // number of papers
            echo "<td>{$firstmax}</td>"; // number of papers
            echo "<td id='{$idif}'>{$totalif}</td>"; // total if
            if ( $nifx[2] == 0 ) {
              echo "<td style='color:red'>待审核</td>"; // total if
            } else if ( $nifx[2] == 1 ) {
              echo "<td style='color:green'>已审核</td>"; // total if
            }
            echo "</tr>";
            echo "<p id='$idy' style='display:none'>{$ap[$j][1]}</p>"; // cardid
          }
        }
      }
      $idy = $idb."num";
      echo "<p id='$idy' style='display:none'>{$nl}</p>";
      echo "</table>";
    }elseif($row[4]==1){ // 历年奖学金
    }
  }
  echo "</div>";
  echo "<p id='nactive' style='display:none'>{$nactive}</p>";
?>

<?php include_once('addJXJModal.php'); ?>
<?php include_once('delJXJModal.php'); ?>
<?php include_once('addIFModal.php'); ?>
<?php include_once('modModal.php'); ?>
<?php include_once('archiveModal.php'); ?>
<?php include_once('upJXJStatusModal.php'); ?>
</body>
</html>
