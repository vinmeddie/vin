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
header('location:profile3.php?user='.$id);
exit();
}

if($action=='cancel')
{
mysql_query("DELETE FROM friend_req WHERE fromm='".$_SESSION['username']."' AND too='".$user."'");
header('location:profile3.php?user='.$id);
exit();
}


if($action=='accept')
{
mysql_query("DELETE FROM friend_req WHERE fromm='".$user."' AND too='".$_SESSION['username']."'");
mysql_query("INSERT INTO friend VALUES('','".$user."','".$_SESSION['username']."',now())");

header('location:profile3.php?user='.$id);
exit();
}

if($action=='unfriend')
{
mysql_query("DELETE FROM friend WHERE userone='".$_SESSION['username']."' AND usertwo='".$user."' OR userone='".$user."' AND usertwo='".$_SESSION['username']."'");
header('location:profile3.php?user='.$id);
exit();
}

if($action=='follow')
{
mysql_query("INSERT INTO follow VALUES('','".$_SESSION['username']."','".$user."')");
header('location:profile3.php?user='.$id);
exit();
}

if($action=='unfollow')
{
mysql_query("DELETE FROM follow WHERE userone='".$_SESSION['username']."' AND usertwo='".$user."'");
header('location:profile3.php?user='.$id);
exit();
}

?>
