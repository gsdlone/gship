<?php
session_start();
include('../conn.php');

$idcard=$_SESSION['cardid'];
if ( $_SESSION['normal'] == "normal" && strlen($idcard) == 32 ) {
} else {
  header("Location: ../index.php");
}
$id = $_POST["id"];
$journal = $_POST["journal"];
$title = $_POST["title"];
$doi = $_POST["doi"];
$choice = $_POST["stat"];

$nauthors = $_POST["nauthors"];
$seq = $_POST["seq"];
$coaffi = $_POST["coaffi"];
$coauthor = $_POST["coauthor"];
$ncoauthor = $_POST["ncoauthor"];
$mycoauthor = $_POST["mycoauthor"];
$supervisor = $_POST["supervisor"];

if($coaffi=="true"){
  if($coauthor=="true"){
    $weight=1.0;
  }elseif($seq==1){
    $weight=1.0;
  }elseif($seq==2){
    $weight=0.5;
  }elseif($seq==3){
    $weight=0.3;
  }else{
    $weight=0.0;
  }
}else{
  $weight = 0.0;
}

$sql = "SELECT journal,ifactor FROM impact where journal='{$journal}'"; 
$res=mysql_query($sql);
if( $r = mysql_fetch_assoc($res) ){
  $ifactor=$r['ifactor'];
} else {
  $ifactor = 0;
  $weight = 0.0;
}


$sql = "SELECT * FROM journals where idcard='{$idcard}' and doi='{$doi}' and id<>'{$id}'"; 
$res=mysql_query($sql);
if( $r = mysql_fetch_row($res) ){
  echo -1;
  exit;
}

$sql = "SELECT * FROM journals where idcard='{$idcard}' and id='{$id}'"; 
$res=mysql_query($sql);
$r = mysql_fetch_assoc($res);
$award0 = $_POST['award'];
$award = $r['award'];
$status = $r['status'];
if ( $choice == '待修改' ) {
  $jxjs = explode("|",$award);
  $n = count($jxjs);
  $n--;
  for ( $i=0; $i<$n; $i++ ) {
    if ( $jxjs[$i] == $award0 ) {
      $j = 4*$i + 2; 
      $status[$j] = 'R';
    }
  }
}

$sql = "UPDATE journals SET journal='$journal', title='$title', doi='$doi', ifactor='$ifactor', nauthors='$nauthors', seq='$seq', coaffi='$coaffi', coauthor='$coauthor', ncoauthor='$ncoauthor',mycoauthor='$mycoauthor',supervisor='$supervisor', weight='$weight', award='$award', status='$status' WHERE idcard='$idcard' and id='$id'";
$result=mysql_query($sql);
?>
