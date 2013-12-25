<?php
session_start();
?>
<?php
include('check.php');
include('config.php');
$id=$_GET['user'];

$uuu=$_GET['edit'];


$sql="SELECT * FROM users WHERE id='".$id."' LIMIT 1";
$res=mysql_query($sql) or die(mysql_error());
if(mysql_num_rows($res)==1)
{
while($row=mysql_fetch_assoc($res))
{

$u=$row['username'];
$d=$row['date_activated'];
$e=$row['email'];
$f=$row['fname'];
$l=$row['lname'];
$p=$row['password'];
$dob=$row['dateofbirth'];
$ab=$row['aboutme'];
$genn=$row['gender'];

$a=date("M j,Y",strtotime($row['age']));


}


if(isset($_POST['sub']))
{
$errors=array();
if($_POST['uu']=='')
{
$errors[]="<font size=2 color='red'>Please provide a <b>Username</b></font>";
}
if($_POST['fnn']=='')
{
$errors[]="<font size=2 color='red'>Please provide a <b>Firstname</b></font>";
}
if($_POST['lnn']=='')
{
$errors[]="<font size=2 color='red'>Please provide a <b>Lastname</b></font>";
}

if($_POST['gen']=='')
{
$errors[]="<font size=2 color='red'>Please provide a <b>Gender</b></font>";
}

if($_POST['date']=='choose a date')
{
$errors[]="<font size=2 color='red'>Please provide a <b>Date</b></font>";
}
if($_POST['month']=='choose a month')
{
$errors[]="<font size=2 color='red'>Please provide a <b>Month</b></font>";
}
if($_POST['year']=='choose a year')
{
$errors[]="<font size=2 color='red'>Please provide a <b>Year</b></font>";
}

//if($_POST['date']!=='choose a date' && $_POST['month']!=='choose a date' && $_POST['year']!=='choose a date')
//{
$datee=$_POST['month'].$_POST['date'].", ".$_POST['year'];
//}

//echo "<br>dddd".$_POST['gen'];


if($_POST['abtme']=='')
{
$errors[]="<font size=2 color='red'>Please provide <b>About me</b> Info</font>";
}
if($_POST['pp']=='')
{
$errors[]="<font size=2 color='red'>Please provide a <b>Password</b></font>";
}


if(empty($errors))
{
mysql_query("UPDATE friend set userone='".mysql_real_escape_string(strip_tags(trim($_POST['uu'])))."' WHERE userone='".$u."'") or die(mysql_error());

mysql_query("UPDATE friend set usertwo='".mysql_real_escape_string(strip_tags(trim($_POST['uu'])))."' WHERE usertwo='".$u."'") or die(mysql_error());

mysql_query("UPDATE follow set userone='".mysql_real_escape_string(strip_tags(trim($_POST['uu'])))."' WHERE userone='".$u."'") or die(mysql_error());

mysql_query("UPDATE follow set usertwo='".mysql_real_escape_string(strip_tags(trim($_POST['uu'])))."' WHERE usertwo='".$u."'") or die(mysql_error());


mysql_query("UPDATE users set fname='".$_POST['fnn']."',lname='".$_POST['lnn']."',username='".$_POST['uu']."',password='".$_POST['pp']."', aboutme='".$_POST['abtme']."',gender='".$_POST['gen']."',dateofbirth='".$datee."' WHERE id='".$id."'") or die(mysql_error());

mysql_query("UPDATE chat set user_id='".mysql_real_escape_string(strip_tags(trim($_POST['uu'])))."' WHERE user_id='".$_SESSION['username']."'");
mysql_query("UPDATE chat set tooo='".mysql_real_escape_string(strip_tags(trim($_POST['uu'])))."' WHERE tooo='".$_SESSION['username']."'");
mysql_query("UPDATE chat set owner='".mysql_real_escape_string(strip_tags(trim($_POST['uu'])))."' WHERE owner='".$_SESSION['username']."'");

mysql_query("UPDATE topics set topiccreator='".$_POST['uu']."' WHERE topiccreator='".$u."'") or die(mysql_error());

mysql_query("UPDATE topics set lastupdated='".$_POST['uu']."' WHERE lastupdated='".$u."'") or die(mysql_error());

mysql_query("UPDATE posts set postcreator='".$_POST['uu']."' WHERE postcreator='".$u."'") or die(mysql_error());


header('location:logout.php');
exit();
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
	<p><font size="3" color='white'><b>Edit Your Full Details</b></font></p>
	</td></tr>
	
		<tr><td align="left">
	<hr>
	</td></tr>
	
		<tr><td align="left">
		
		
		
		
		<table align='left'>

<?php
if(isset($_GET['error']) && $_GET['error']==1)
{
echo "<tr><td colspan=3 ><h4 align='center'>Please complete your profile to continue</h4><form action='' method='POST' enctype='multipart/form-data'>      </td></tr>
";
}


?>
<form action='' method='POST' enctype='multipart/form-data'> 

<tr><td colspan=3><font color='red'><?php if(isset($errors)){foreach($errors as $error){echo $error.'<br>';}}?></font></td></tr>
<tr><td><font size=2>Username:</font></td><td><input type='text' name='uu' value='<?php echo $u;?>' ></td></tr>
<tr><td><font size=2>First name:</font></td><td><input type='text' name='fnn' value='<?php echo $f;?>' ></td></tr>
<tr><td><font size=2>Last name:</font></td><td><input type='text' name='lnn' value='<?php echo $l;?>'></td></tr>

<?php
$sqlg="SELECT * FROM users WHERE id='".$id."' LIMIT 1";
$resg=mysql_query($sqlg) or die(mysql_error());
$g=mysql_fetch_assoc($resg);
if($g['gender']=='')
{
echo"<tr><td><font size=2>Gender:</font></td><td><input type='radio' name='gen' value='male' >Male<input type='radio' name='gen' value='female' >Female</td></tr>";
}
else
{
echo "<td><input type='hidden' name='gen' value='".$genn."'>";
}

if($g['dateofbirth']=='')
{
echo"<tr><td><font size=2>Date of Birth:</font></td><td>
<select name='date'>";
echo "<option value='choose a date'>choose a date</option>";
for($i=1;$i<=31;$i++)
{
echo "<option value=".$i.">".$i."</option>";
}

echo "
</select>


<select name='month'>";
echo "<option value='choose a month'>choose a month</option>";
echo "<option value='Jan'>Jan</option>";
echo "<option value='Feb'>Feb</option>";
echo "<option value='Mar'>Mar</option>";
echo "<option value='Apr'>Apr</option>";
echo "<option value='May'>May</option>";
echo "<option value='Jun'>Jun</option>";
echo "<option value='July'>July</option>";
echo "<option value='Aug'>Aug</option>";
echo "<option value='Sept'>Sept</option>";
echo "<option value='Oct'>Oct</option>";
echo "<option value='Nov'>Nov</option>";
echo "<option value='Dec'>Dec</option>";

echo "</select>



<select name='year'>";
echo "<option value='choose a year'>choose a year</option>";
for($y=1980;$y<=2030;$y++)
{

echo "<option value=".$y.">".$y."</option>";
}

echo "
</select>


</td></tr>";
}
else
{
echo "<td><input type='hidden' name='gen' value='".$dob."'>";
}

?>

<tr><td><font size=2>About me:</font></td><td><textarea id='m' name='abtme' rows=4% cols=50%><?php echo $ab;?></textarea><br></td></tr>
<tr><td><font size=2>Password:</font></td><td><input type='password' name='pp' value='<?php echo $p;?>'></td></tr>

<tr><td>&nbsp;</td><td><input type='submit' name='sub' value='Edit <?php echo ucfirst($uuu);?>' ></td></tr>
<tr><td colspan=3>&nbsp;</td></tr>
<tr><td colspan=3 align='center'><font size=2>After editing your <br><b>password</b> or <b>username</b>, <br>you will be signed out automatically for your account to be updated</td></tr>
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