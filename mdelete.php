<?php session_start();?>
<?php
include('config.php');
if(isset($_GET['id']))
{

mysql_query("DELETE FROM messages WHERE msgid='".$_GET['id']."' AND todelete='".$_SESSION['uid']."' ");

header("location:reply.php?msgid=".$_GET['msgid']."&msgto=".$_GET['msgto']."&msgfrom=".$_GET['msgfrom']."");
}


?>