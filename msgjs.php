<?php
session_start();
?>
<?php
include("config.php");
$sql="SELECT * FROM messages WHERE msgto='".$_SESSION['uid']."' AND status='unread' AND todelete='".$_SESSION['uid']."'";
$res=mysql_query($sql) or die(mysql_error());
$mk=mysql_num_rows($res);

echo " <font color='red'>".$mk."</font>";




?>