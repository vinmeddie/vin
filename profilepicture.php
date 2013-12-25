<?php 
session_start();
?>
<?php
include('check.php');
include('config.php');
$id=$_GET['user'];

$uuu=$_GET['edit'];



if($uuu=='avatar')
{
$sql="SELECT profilepicture FROM users WHERE id='".$id."' LIMIT 1";

$res=mysql_query($sql) or die(mysql_error());
if(mysql_num_rows($res)==1)
{
while($row=mysql_fetch_assoc($res))
{

$avatar=$row['profilepicture'];

}
}

if(isset($_POST['sub']))
{

if(isset($_FILES['avi']))
{

/*
if($_POST['avi']=='')
{
$_POST['avi']=$avatar;
}
*/

$errors=array();

$allowed_ext=array('jpg','jpeg','png','gif');
$file_name=$_FILES['avi']['name'];
$file_ext=strtolower(end(explode('.',$file_name)));
$file_size=$_FILES['avi']['size'];
$file_tmp=$_FILES['avi']['tmp_name'];

if(in_array($file_ext,$allowed_ext)===false)
{
$errors[]="file extension not allowed";
}
/*
if($file_size>50600)
{
$errors[]="file size must not exceed 50kb";
}
*/

if(empty($errors))
{
include("imgresize.php");
if(file_exists('../users/'.$id.'/images/'.$avatar))
{
unlink('../users/'.$id.'/images/'.$avatar);
}


mysql_query("UPDATE users set profilepicture='".$file_name."' WHERE id='".$id."'");

if(!file_exists("../users/".$id))
{
mkdir("../users/".$id,0755);
}

if(!file_exists("../users/".$id."/images"))
{
mkdir("../users/".$id."/images",0755);

}
//echo '../users/'.$_SESSION['uid'].'/images/'.$file_name;
move_uploaded_file($file_tmp,'../users/'.$_SESSION['uid'].'/images/'.$file_name );

vin('../users/'.$_SESSION['uid'].'/images/'.$file_name,'../users/'.$_SESSION['uid'].'/images/'.$file_name,110,200);


header('location:index.php');
exit();
}
else
{
foreach($errors as $error) 
{
$ro= $error."<br>";
}

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
	<p><font size="3" color='white'><b>Edit Profile Picture</b></font></p>
	</td></tr>
	
		<tr><td align="left">
	<hr>
	</td></tr>
	
		<tr><td align="left">
		
		
		
		
		
		<table align='left' border=0>

<form action='' method='POST' enctype='multipart/form-data'>
<tr><td colspan='2' align='left'><font color='red'><?php if(isset($errors)){foreach($errors as $error){echo $error.'<br>';}}?></font></td></tr>

<tr><td align="left"><font size=2>Upload avatar:</font></td><td><input type='file' name='avi' value='<?php echo $avatar;?>'></td></tr>

<tr><td>&nbsp;</td><td><input type='submit' name='sub' value='Edit'></td></tr>
</form>
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