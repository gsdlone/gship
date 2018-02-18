<?php
if(!file_exists("config/config.php")){
  header('Content-Type:text/html; charset=utf-8');

  $institution = $_POST['institution'];
  $dbname      = $_POST['dbname'];
  $dbuser      = $_POST['dbuser'];
  $dbpasswd    = $_POST['dbpassword'];
  $sysuser     = $_POST['sysuser'];
  $syspasswd   = md5($_POST['syspassword']);

  $str = "
<?php
\$dbname=\"${dbname}\";
\$con = mysql_connect(\"localhost\",\"${dbuser}\",\"${dbpasswd}\");
\$sitename = \"${institution}\";
\$sysuser  = \"${sysuser}\";
\$syspasswd = \"${syspasswd}\";
?>
";
  echo $str;
  $myfile = fopen("config/config.php", "w");
  fwrite($myfile, $str);
  fclose($myfile);

  header("Location: index.php");      
}
?>
