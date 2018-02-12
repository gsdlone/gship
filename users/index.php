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
  <title>奖学金评审系统</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="../jquery/1.12.4/jquery.min.js"></script>
  <script src="../bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="js/typeahead.bundle.min.js"></script>
  <script src="js/delete.js"></script>
  <script src="js/editPaper.js"></script>
  <script src="js/addPaper.js"></script>
  <script src="js/jxjsel.js"></script>
  <script src="js/update.js"></script>
  <script src="js/upinfo.js"></script>
  <script src="js/handlebars.js"></script>
  <script src="js/examples.js"></script>
  <script src="js/icheck.js"></script>
  <link rel="stylesheet" href="css/examples.css">
  <link rel="stylesheet" href="css/outline.css">
  <link rel="stylesheet" href="css/custom.css">
  <link href="skins/all.css" rel="stylesheet">
</head>
<body>
<!-- navbar -->
<?php include_once('nav.php'); ?>
<?php include_once('info.php');// informations for AJAX ?> 
<?php include_once('intro.php'); ?>
<!-- table -->
<!-- <div class="div1 container-fluid box-shadow"> -->
<div class="div1 container-fluid">
 <table id="main_table" class='table table-bordered table-striped table-condensed table-hover'>
   <thead> <?php include_once('tableControl.php'); ?> </thead>
   <thead> <?php include_once('tableHead.php'); ?> </thead>
   <tbody> <?php include_once('mainTable.php'); ?> </tbody>
 </table>
</div>
<!-- table -->
<?php
  include_once('delete_confirm.php');
  include_once('addPaperModal.php');
  include_once('upinfoModal.php');
  //include_once("../footer.php");
?>
<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>
</body>
</html>
