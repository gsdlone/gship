<?php
if(!file_exists("json/config.php")){
  header('Content-Type:text/html; charset=utf-8');

  $institution = $_POST['institution'];
  $dbname      = $_POST['dbname'];
  $dbuser      = $_POST['dbuser'];
  $dbpasswd    = $_POST['dbpassword'];
  $sysuser     = $_POST['sysuser'];
  $syspasswd   = md5($_POST['syspassword']);
  $adminphone  = $_POST['adminphone'];

  $str = "
<?php
\$dbname=\"${dbname}\";
\$con = mysql_connect(\"localhost\",\"${dbuser}\",\"${dbpasswd}\");
\$sitename = \"${institution}\";
\$sysuser  = \"${sysuser}\";
\$syspasswd = \"${syspasswd}\";
\$adminphone = \"${adminphone}\";
?>
";
  echo $str;
  $myfile = fopen("json/config.php", "w");
  fwrite($myfile, $str);
  fclose($myfile);

  header("Location: index.php");      
}
?>
