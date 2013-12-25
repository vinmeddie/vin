<?php
session_start();
?>
<?php
include('config.php');
mysql_query("UPDATE users set lastsession=now() WHERE username='".$_SESSION['username']."'");
$sql1=mysql_query("DELETE FROM active_members WHERE username='".$_SESSION['username']."'");
session_destroy();
header('location:login.php');
exit();
?>