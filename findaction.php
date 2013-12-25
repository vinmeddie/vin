<?php
session_start();
?>
<?php
include('check.php');
include('config.php');
include('functions.php');
$action=$_GET['action'];
$user=$_GET['user'];

$sqol="SELECT * FROM users WHERE username='".$_GET['user']."' LIMIT 1";
$reso=mysql_query($sqol) or die(mysql_error());
$y=mysql_fetch_assoc($reso);
$id=$y['id'];


if($action=='send')
{
mysql_query("INSERT INTO friend_req VALUES('','".$_SESSION['username']."','".$user."')");
header('location:find.php');
exit();
}

if($action=='cancel')
{
mysql_query("DELETE FROM friend_req WHERE fromm='".$_SESSION['username']."' AND too='".$user."'");
header('location:find.php');
exit();
}


if($action=='accept')
{
mysql_query("DELETE FROM friend_req WHERE fromm='".$user."' AND too='".$_SESSION['username']."'");
mysql_query("INSERT INTO friend VALUES('','".$user."','".$_SESSION['username']."',now())");

header('location:find.php');
exit();
}




?>
