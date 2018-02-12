<?php
session_start();
if(!isset($_SESSION['admin'])){
  header('Content-Type:text/html; charset=utf-8');
  echo "错误!没有权限!";
  exit(0);
}
include("../conn.php");

$info = pathinfo($_FILES["file"]["name"]);
$type = $info['extension'];
$name = $_FILES["file"]["tmp_name"];

$version = '5';
if($type == 'xlsx'){
  $version = '2007';
}

include_once 'PHPExcel/PHPExcel/IOFactory.php';
$reader   = PHPExcel_IOFactory::createReader('Excel'.$version);
$PHPExcel = $reader->load($name);
$sheet    = $PHPExcel->getSheet(0);
$highestRow    = $sheet->getHighestRow(); 
$highestColumm = $sheet->getHighestColumn();

//$sql = "DELETE FROM impact";
$sql = "TRUNCATE TABLE impact";
$res=mysql_query($sql);

for ($i = 1; $i <= $highestRow; $i++){
  $journal = $sheet->getCell('A'.$i)->getValue();
  $ifactor = $sheet->getCell('B'.$i)->getValue(); 

  if(!is_numeric($ifactor)){
  $ifactor = 0.0;
  }

  $sql = "INSERT INTO impact (journal,ifactor) VALUES ('$journal','$ifactor')";
  $res=mysql_query($sql);
}

$myfile=fopen("../json/journals.json","w");
$sql = "SELECT journal FROM impact"; 
$res=mysql_query($sql);
$rows=array();
while( $r = mysql_fetch_assoc($res) ){
  $rows[]=$r['journal'];
}

fwrite($myfile,json_encode($rows));
fclose($myfile);
?>
