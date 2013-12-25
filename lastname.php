<?php 
session_start();
?>
<?php
include('check.php');
include('config.php');
$id=$_GET['user'];

$uuu=$_GET['edit'];


if($uuu=='lastname')
{
$sql="SELECT lname FROM users WHERE id='".$id."' LIMIT 1";

$res=mysql_query($sql) or die(mysql_error());
if(mysql_num_rows($res)==1)
{
while($row=mysql_fetch_assoc($res))
{

$l=$row['lname'];

}
}

if(isset($_POST['sub']))
{

$errors=array();
if(trim($_POST['lnn'])=='')
{
$errors[]="<font size=2 color='red'>Please provide a <b>Lastname</b></font>";
}
else
{
if(is_numeric($_POST['lnn'][0]))
{
$errors[]="Lastname can not begin with a numeric";
}

if(strlen(trim($_POST['lnn']))<3)
{
$errors[]="Lastname must be more than 3 characters";
}

if(strlen(trim($_POST['lnn']))>15)
{
$errors[]="Lastname must be less than 15 characters";
}

}

if(empty($errors))
{
$sqlc="SELECT * FROM users WHERE lname='".trim($_POST['lnn'])."'";
$resc=mysql_query($sqlc) or die(mysql_error());

if(mysql_num_rows($resc)<'1')
{

mysql_query("UPDATE users set lname='".trim(strtolower($_POST['lnn']))."' WHERE id='".$id."'");
header('location:profile3.php?view=info&user='.$_SESSION['uid']);

}
else
{

$errors[]= "<font size=2 color='red'><b>Lastname</b> cannot be the same</font><br>";

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
	<p><font size="3" color='white'><b>Edit Your Lastname</b></font></p>
	</td></tr>
	
		<tr><td align="left">
	<hr>
	</td></tr>
	
		<tr><td align="left">
		
		
		
		
		
				<table align='left'>
<form action='' method='POST' enctype='multipart/form-data'> 
<tr><td colspan=3 align='left'><font color='red'><?php if(isset($errors)){foreach($errors as $error){echo $error.'<br>';}}?></font></td></tr>
<tr><td align='left'><font size=2>Last name:</font></td><td><input type='text' name='lnn' value='<?php echo $l;?>'></td></tr>


<tr><td>&nbsp;</td><td><input type='submit' name='sub' value='Edit <?php echo ucfirst($uuu);?>' ></td></tr>
<tr><td colspan=3>&nbsp;</td></tr>
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