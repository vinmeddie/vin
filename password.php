<?php 
session_start();
?>
<?php
include('check.php');
include('config.php');
$id=$_GET['user'];

$uuu=$_GET['edit'];


if($uuu=='password')
{
$sql="SELECT password FROM users WHERE id='".$id."' LIMIT 1";

$res=mysql_query($sql) or die(mysql_error());
if(mysql_num_rows($res)==1)
{
while($row=mysql_fetch_assoc($res))
{

$p=$row['password'];
}
}

if(isset($_POST['sub']))
{

$errors=array();
if(trim($_POST['pp'])=='')
{
$errors[]="<font size=2 color='red'>Please provide a <b>Password</b></font>";
}
else
{

if(strlen(trim($_POST['pp']))<3)
{
$errors[]="Password must be more than 3 characters";
}

if(strlen(trim($_POST['pp']))>15)
{
$errors[]="Password must be less than 15 characters";
}

}

if(empty($errors))
{


$sqlcd="SELECT * FROM users WHERE password='".trim($_POST['pp'])."'";
$rescd=mysql_query($sqlcd) or die(mysql_error());

if(mysql_num_rows($rescd)<'1')
{

mysql_query("UPDATE users set password='".trim(strtolower($_POST['pp']))."' WHERE id='".$id."'");
header('location:logout.php');
exit();
}
else
{
$errors[]= "<font size=2 color='red'><b>Password</b> cannot be the same</font><br>";
}
}


}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width-device-width">
<meta name="description" content="Vinnettech helps you make friends." />
<meta name="HandheldFriendly" content="true" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta name="referrer" content="default" id="meta_referrer" />
<meta http-equiv="X-Frame-Options" content="DENY" />
<meta name="MobileOptimized" content="320">
<link rel='stylesheet' type='text/css' href='css.css'/>
<link rel='stylesheet' type='text/css' href='header.css'/>


<title>VinNetTech</title>
</head>

<body>

<div class="container">

<?php include('header.php')?>

  <div class="content">
  
  

    
	<table width="100%" border="0" cellspacing="0" cellpadding="0">

	
	<tr><td align="left">
	<p><font size="3" color='white'><b>Edit Your Password</b></font></p>
	</td></tr>
	
		<tr><td align="left">
	<hr>
	</td></tr>
	
		<tr><td align="left">
		
		
		
		
		
				<table align='left'>
<form action='' method='POST' enctype='multipart/form-data'>
<tr><td colspan=3 align='left'><font color='red'><?php if(isset($errors)){foreach($errors as $error){echo $error.'<br>';}}?></font></td></tr>
<tr><td align='left'><font size=2>Password:</font></td><td><input type='password' name='pp' value='<?php echo $p;?>'></td></tr>

<tr><td>&nbsp;</td><td><input type='submit' name='sub' value='Edit <?php echo ucfirst($uuu);?>' ></td></tr>
<tr><td colspan=3>&nbsp;</td></tr>
<tr><td colspan=3 align='center'><font size=2>After editing your <br><b>password</b>, <br>you will be signed out automatically for your account to be updated</td></tr>
</table>
		
		
		
		
		
		

	</td></tr>
	
	
	
		
	</table>
 
  
        </div>
  <div class="footer" align="center">
    <p><?php include("footer.php");?></p>
    <!-- end .footer --></div>
  <!-- end .container --></div>
  
 
</body>
</html>