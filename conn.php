<?php
include("json/config.php");
mysql_query("set names 'UTF8'");
mysql_query("set character 'UTF8'");

if(!$con) {
  unlink("./json/config.php");
  die("数据库用户名或密码错误！");
}

$db_selected = mysql_select_db($dbname, $con);
if(!$db_selected) {
  $sql="CREATE DATABASE $dbname";
  if(mysql_query($sql,$con)){
    echo "Database $dbname created successfully\n";
    $db_selected=mysql_select_db($dbname,$con);

/////////////////// create table
$sql = "CREATE TABLE IF NOT EXISTS admin (
id        INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
username  VARCHAR(255) NOT NULL,
password  VARCHAR(255) NOT NULL)";	

$res = mysql_query($sql);

$sql = "CREATE TABLE IF NOT EXISTS users (
id        INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
cardid    VARCHAR(40)  NOT NULL,
name      VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
phone     VARCHAR(255) NOT NULL,
telp      VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
email     VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
major     VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
readway   VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
teacher   VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
year      INT(11)      NOT NULL,
password  VARCHAR(255) NOT NULL,
arp       VARCHAR(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
skind     VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
national  VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL)";

$res = mysql_query($sql);

$sql = "CREATE TABLE IF NOT EXISTS journals (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  idcard VARCHAR(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  journal VARCHAR(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  title VARCHAR(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  doi VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  ifactor REAL NOT NULL,
  nauthors INT NOT NULL,
  seq INT NOT NULL,
  coaffi VARCHAR(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  coauthor VARCHAR(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  weight REAL NOT NULL,
  award VARCHAR(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  status VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  ncoauthor INT NOT NULL,
  supervisor VARCHAR(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  patent VARCHAR(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
)";
$res = mysql_query($sql);

$sql = "CREATE TABLE IF NOT EXISTS impact (
id       INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
journal  VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
ifactor  REAL NOT NULL)";	

$res = mysql_query($sql);

$sql = "CREATE TABLE IF NOT EXISTS jxjkinds (
id       INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
jxjname  VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
jxjid    INT(4) NOT NULL,
status   TINYINT(1) NOT NULL,
statusx  TINYINT(1) NOT NULL)";
$res = mysql_query($sql);

$sql = "CREATE TABLE IF NOT EXISTS students (
id       INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
idcard VARCHAR(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
award VARCHAR(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
nif VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
)";
$res = mysql_query($sql);

$sql = "CREATE TABLE IF NOT EXISTS archived (
id      INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
cardid  VARCHAR(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
award   VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
ifactor   VARCHAR(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
)";	
$res = mysql_query($sql);
/////////////////// create table
$sql = "insert into admin (username,password) values ('${sysuser}','${syspasswd}')";
$res = mysql_query($sql);
/////////////////// create table
  }
}
?>
