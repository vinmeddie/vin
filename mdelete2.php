<?php session_start();?>
<?php
include('config.php');
if(isset($_POST['id']))
{

mysql_query("DELETE FROM messages WHERE msgid='".$_POST['id']."' AND todelete='".$_SESSION['uid']."' ");

}


?>