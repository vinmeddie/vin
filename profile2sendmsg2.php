<?php
session_start();
?>
<?php
include('check.php');
include('config.php');

if(isset($_POST['n']) && isset($_POST['m']))
{

$er=array();


if(($_POST['n']=='choose a name'))
{
$er[]="Please choose a name";
}
 
 if(($_POST['m']==''))
{
$er[]="Please write a message to send";
}
 
 if(empty($er))
 {

if(isset($_SESSION['admin']))
{
$_SESSION['uid']=$_SESSION['aduid'];
}

$sql01="INSERT INTO messages (msgfrom,msgto,msgcontent,msgtime) VALUES ('".$_SESSION['uid']."','".$_POST['n']."','".mysql_real_escape_string(strip_tags(trim($_POST['m'])))."',now())";
mysql_query($sql01) or die(mysql_error());

$i= "Message sent successfully to <font color='black'><b>".ucfirst($_GET['user'])."</b>";
//header('location:users.php'); 
 }
  


}

if($er){foreach($er as $ers){echo "<font size='2' color='red'>".$ers.'<>/font<br>';}}
?>
