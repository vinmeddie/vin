<?php
session_start();
?>
<?php

include('check.php');
include('config.php');

if(isset($_POST['n']) && isset($_POST['m']))
{

$sql01="INSERT INTO messages (msgfrom,msgto,msgcontent,msgtime,todelete) VALUES ('".$_SESSION['uid']."','".$_POST['n']."','".mysql_real_escape_string(strip_tags(trim($_POST['m'])))."',now(),'".$_POST['n']."')";
$sql02="INSERT INTO messages (msgfrom,msgto,msgcontent,msgtime,todelete) VALUES ('".$_SESSION['uid']."','".$_POST['n']."','".mysql_real_escape_string(strip_tags(trim($_POST['m'])))."',now(),'".$_SESSION['uid']."')";

mysql_query($sql01) or die(mysql_error());
mysql_query($sql02) or die(mysql_error());

}
  

?>