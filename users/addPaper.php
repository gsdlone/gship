<?php
session_start();
include('../conn.php');
include('../libs.php');
// check if variable is set and Add Journal Button pressed.
$idcard=$_SESSION['cardid'];
if ( $_SESSION['normal'] == "normal" && strlen($idcard) == 32 ) {
} else {
  header("Location: ../index.php");
}
$journal = $_POST["journal"];
$title = $_POST["title"];
$doi = $_POST["doi"];

$nauthors = $_POST["nauthors"];
$seq = $_POST["seq"];
$coaffi = $_POST["coaffi"];
$coauthor = $_POST["coauthor"];
$ncoauthor = $_POST["ncoauthor"];
$supervisor = $_POST["supervisor"];
$patent = $_POST["patent"];

$weight = calweight($coaffi, $coauthor, $ncoauthor, $seq);
$sql = "SELECT journal,ifactor FROM impact where journal='{$journal}'"; 
$res=mysql_query($sql);
if( $r = mysql_fetch_assoc($res) ){
  $ifactor=$r['ifactor'];
} else {
    if($patent == "true"){
        $ifactor = 20.0;        
    }else{
        $ifactor = 0;
    }
}

$award = "";
$status = "";

if($_POST["submit"]=="Add Journal")
{
  $sql = "SELECT * FROM journals where idcard='{$idcard}' and doi='{$doi}'"; 
  $res=mysql_query($sql);
  if( $r = mysql_fetch_row($res) ){
    echo -1;
    exit;
  }
  $sql = "INSERT INTO journals (idcard,journal,title,doi,ifactor,nauthors,seq,coaffi,coauthor,weight,award,status,ncoauthor,supervisor,patent) VALUES ('$idcard','$journal','$title','$doi','$ifactor','$nauthors','$seq','$coaffi','$coauthor','$weight','$award','$status','$ncoauthor','$supervisor','$patent')";
  $result=mysql_query($sql,$con);
}

if($_POST["submit"]=="Edit Journal"){
  $id = $_POST["id"];

  $sql = "SELECT * FROM journals where idcard='{$idcard}' and doi='{$doi}' and id<>'{$id}'"; 
  $res=mysql_query($sql);
  if( $r = mysql_fetch_row($res) ){
    echo -1;
    exit;
  }
  $sql = "UPDATE journals SET journal='$journal', title='$title', doi='$doi', ifactor='$ifactor', nauthors='$nauthors', seq='$seq', coaffi='$coaffi', coauthor='$coauthor', weight='$weight', ncoauthor='$ncoauthor', supervisor='$supervisor', patent='$patent' WHERE idcard='$idcard' and id='$id'";
  $result=mysql_query($sql,$con);
}
?>
