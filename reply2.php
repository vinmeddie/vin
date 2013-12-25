<?php
session_start();
?>
<?php
if($_POST['m']!='')
{
include("config.php");


$guest_timeout=time()-5*60;
$members_timeout=time()-5*60;
$guest_ip=$_SERVER['REMOTE_ADDR'];
$time=time();


if(empty($_SESSION['username']))
{
mysql_query("INSERT INTO visitors VALUES('','".$guest_ip."')");
}

if(isset($_SESSION['admin']))
{
$_SESSION['uid']=$_SESSION['aduid'];
}


if(isset($_SESSION['admin']))
{
$_SESSION['username']=$_SESSION['admin'];
}



if(isset($_SESSION['username']))
{
$sql=mysql_query("DELETE FROM active_guests WHERE guest_ip='".$guest_ip."'");
$sql2=mysql_query("REPLACE INTO active_members(username,time_visited) VALUES ('".$_SESSION['username']."','".$time."')")or die(mysql_error());
}
else
{

$sql3=mysql_query ("REPLACE INTO active_guests(guest_ip,time_visited) VALUES ('".$guest_ip."','".$time."')")or die(mysql_error());
}
$sql4=mysql_query("DELETE FROM active_guests WHERE time_visited <'".$guest_timeout."'")or die(mysql_error());
$sql5=mysql_query("DELETE FROM active_members WHERE time_visited <'".$members_timeout."'")or die(mysql_error());
$sql6=mysql_query("SELECT guest_ip FROM active_guests")or die(mysql_error());
$online_guests=mysql_num_rows($sql6);
$sql7=mysql_query("SELECT username FROM active_members");
$online_members=mysql_num_rows($sql7);



$msgfrom=$_POST['msgfrom'];
$ss="UPDATE messages set status='read' WHERE msgto='".$_SESSION['uid']."' AND msgfrom='".$msgfrom."' AND todelete='".$_SESSION['uid']."'";
$rr=mysql_query($ss) or die(mysql_error());


$sql01="INSERT INTO messages (msgfrom,msgto,msgcontent,msgtime,todelete) VALUES ('".$_SESSION['uid']."','".$_POST['n']."','".mysql_real_escape_string(strip_tags(trim($_POST['m'])))."',now(),'".$_POST['n']."')";
$sql02="INSERT INTO messages (msgfrom,msgto,msgcontent,msgtime,todelete) VALUES ('".$_SESSION['uid']."','".$_POST['n']."','".mysql_real_escape_string(strip_tags(trim($_POST['m'])))."',now(),'".$_SESSION['uid']."')";

mysql_query($sql01) or die(mysql_error());
mysql_query($sql02) or die(mysql_error());

}

?>