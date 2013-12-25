<?php
session_start();
?>
<?php
include('check.php');
include('config.php');
$id=$_GET['user'];

$uuu=$_GET['edit'];


if($uuu=='username')
{
$sql="SELECT username FROM users WHERE id='".$id."' LIMIT 1";

$res=mysql_query($sql) or die(mysql_error());
if(mysql_num_rows($res)==1)
{
while($row=mysql_fetch_assoc($res))
{

$u=$row['username'];

}
}

if(isset($_POST['sub']))
{
$usernamee=strtolower(trim($_POST['uu']));

$errors=array();
if($usernamee=='')
{
$errors[]="<font size=2 color='red'>Please provide a <b>Username</b></font>";
}
else
{
if(is_numeric($usernamee[0]))
{
$errors[]="Username can not begin with a numeric";
}

if(strlen($usernamee)<3)
{
$errors[]="Username must be more than 3 characters";
}

if(strlen($usernamee)>15)
{
$errors[]="Username must be less than 15 characters";
}

}

if(empty($errors))
{

$sqlc="SELECT * FROM users WHERE username='".$usernamee."'";
$resc=mysql_query($sqlc) or die(mysql_error());

if(mysql_num_rows($resc)<'1')
{

mysql_query("UPDATE friend set userone='".$usernamee."' WHERE userone='".$_SESSION['username']."'") or die(mysql_error());

mysql_query("UPDATE friend set usertwo='".$usernamee."' WHERE usertwo='".$_SESSION['username']."'") or die(mysql_error());

mysql_query("UPDATE follow set userone='".$usernamee."' WHERE userone='".$_SESSION['username']."'") or die(mysql_error());

mysql_query("UPDATE follow set usertwo='".$usernamee."' WHERE usertwo='".$_SESSION['username']."'") or die(mysql_error());


mysql_query("UPDATE users set username='".$usernamee."' WHERE id='".$id."'");
mysql_query("UPDATE chat set user_id='".$usernamee."' WHERE user_id='".$_SESSION['username']."'");
mysql_query("UPDATE chat set tooo='".$usernamee."' WHERE tooo='".$_SESSION['username']."'");
mysql_query("UPDATE chat set owner='".$usernamee."' WHERE owner='".$_SESSION['username']."'");


mysql_query("UPDATE topics set topiccreator='".$usernamee."' WHERE topiccreator='".$u."'") or die(mysql_error());

mysql_query("UPDATE topics set lastupdated='".$usernamee."' WHERE lastupdated='".$u."'") or die(mysql_error());

mysql_query("UPDATE posts set postcreator='".$usernamee."' WHERE postcreator='".$u."'") or die(mysql_error());

//mysql_query("UPDATE postss set lastupdated='".$usernamee."' WHERE lastupdated='".$u."'") or die(mysql_error());



//mysql_query("UPDATE topics set topiccreator='".$usernamee."',lastupdated='".$usernamee."' WHERE topiccreator='".$_SESSION['username']."',lastupdated='".$_SESSION['username']."'") or die(mysql_error());

//mysql_query("UPDATE posts set username='".$usernamee."' WHERE username='".$_SESSION['username']."'");
header('location:logout.php');
exit();
}
else
{

$errors[]= "<font size=2 color='red'><b>Username</b> cannot be the same</font><br>";

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
	<p><font size="3" color='white'><b>Edit Your Username</b></font></p>
	</td></tr>
	
		<tr><td align="left">
	<hr>
	</td></tr>
	
		<tr><td align="left">
		
		
		
		
		
		
				<table align='left'>
<form action='' method='POST' enctype='multipart/form-data'>
<tr><td colspan='2' align='left'><font color='red'><?php if(isset($errors)){foreach($errors as $error){echo $error.'<br>';}}?></font></td></tr>
<tr><td align='left'><font size=2>Username:</font></td><td><input type='text' name='uu' value='<?php echo $u;?>' ></td></tr>


<tr><td>&nbsp;</td><td><input type='submit' name='sub' value='Edit <?php echo ucfirst($uuu);?>' ></td></tr>
<tr><td colspan=3>&nbsp;</td></tr>
<tr><td colspan=3 align='center'><font size=2>After editing your <br><b>username</b>, <br>you will be signed out automatically for your account to be updated</td></tr>
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