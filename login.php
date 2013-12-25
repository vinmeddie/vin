<?php
session_start();
?>
<?php
if(isset($_SESSION['uid']))
{
header('location:index.php');
exit();
}
?>
<?php
include('config.php');
if(isset($_POST['sub']))
{
$e=mysql_real_escape_string(strip_tags(trim($_POST['e'])));
$p=mysql_real_escape_string(strip_tags(trim($_POST['p'])));
$errors=array();
if($p=='')
{
$e2="<p> <font color='red'>Please fill in your <b>Password</b></font> </p>";
}
if($e=='')
{
$e1="<p> <font color='red'>Please fill in your <b>Email</b> or <b>Username</b></font> </p>";
}/*
else
{
if($e!=filter_var($e,FILTER_VALIDATE_EMAIL))
{
$errors[]="unknown email format";
}

}*/

if(empty($e1) && empty($e2))
{
$sql="SELECT * FROM users WHERE email='".$e."' AND password='".$p."' AND activated='1' OR username='".$e."' AND password='".$p."' AND activated='1'";
$res=mysql_query($sql) or die(mysql_error());
if(mysql_num_rows($res)==1)
{
$row=mysql_fetch_assoc($res);
$_SESSION['username']=$row['username'];
$_SESSION['uid']=$row['id'];

header('location:index.php');
exit();

}
else
{
$m= "Invalid details";
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
<link rel='stylesheet' type='text/css' href='jquerycss.css'/>


<link rel="icon" href="favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">



<title>Login</title>
</head>

<body>

<div class="container">
  <div class="header" style="height:40px;">
  
  <div style="position:absolute;line-height:40px;left:5px;"><a style="text-decoration:none;" href="index.php"><font size="6" color="white"><b>VinNetTech</b></font></a> </div>  <div style="position:absolute;line-height:40px;right:5px;"><b><a href="signup.php"><font color="white">Register</font></a></b></div>
   
	
	</div>
  <div class="content">
  
  

    
	<table width="100%" border="0" cellspacing="0" cellpadding="0">

	
	<tr><td align="left">
	<p><font size="3" color='white'><b>Log In Here</b></font></p>
	</td></tr>
	
		<tr><td align="left">
	<hr>
	</td></tr>
	
		<tr><td align="left">
		
		
		
		
		
		
		<table  border="0" width="100%" align='left'>
                          
<tr><td>
<form method="post" action="login.php">
<p><font size="5" color="white">Email or Username</font></p>
		<?php 
		if(isset($e1))
		{
		echo $e1;
		}
		?>
<p><input type="text" name="e" value="<?php echo $e;?>" class='log'/></p>
<p><font size="5" color="white">Password</font></p>
		<?php 
		if(isset($e2))
		{
		echo $e2;
		}
		?>
<p><input type="password" name="p" value="<?php echo $p;?>" class='log'/></p>
                          
                            <?php echo "<p><font color='red'>".$m."</font></p>";?>
                          
<p><input id="login" type="submit" name="sub" value="Log In" style="height:30px;font-size:16pt;" class='sub'/></p>
</form>
</td>
</tr>
	</table>	
		
		
		<?php
		//echo "594308139582#";
		?>
		

	</td></tr>
	
	
	
		
	</table>
 
  
        </div>
  <div class="footer" align="center">
    <p><?php include("footer.php");?></p>
    <!-- end .footer --></div>
  <!-- end .container --></div>
  
  
  
 
</body>
</html>