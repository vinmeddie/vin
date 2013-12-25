<?php
session_start();
?>
<?php
include('functions.php');
include('config.php');


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>VinNetTech</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="viewport" content="width-device-width">
<meta name="description" content="Vinnettech helps you make friends." />
<meta name="HandheldFriendly" content="true" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta name="referrer" content="default" id="meta_referrer" />
<meta http-equiv="X-Frame-Options" content="DENY" />
<meta name="MobileOptimized" content="320">
<link rel='stylesheet' type='text/css' href='css.css'/>
</head>
<body>
<table width="46%" align="center" border="0" cellspacing="0" cellspacing="0">
<tr>
  <td align="center" valign="middle"><table width="100%" border="0" cellspacing="0" cellspacing="0" style="background:#000;opacity:0.9;">
<tr>
  <td bgcolor="green"><table border="0" width="100%" cellspacing="0" cellspacing="0">
<tr>
  <td><font size="6" color='white'><b>VinNetTech</b></font></td>
  <td align="right"><a href="logout.php"><font size="5" color='#ededed'><b>Log Out</b></font></a>&nbsp;</td>
</tr>
</table>
</td>
</tr>
<tr>
  <td bgcolor="#ededed"><table class="_4g33" border="0" width="100%" cellspacing="0" cellspacing="0">
<tr>
  <td bgcolor="" align="left"><?php
$username= getuser('users','username','id',$_SESSION['uid']);
$id= getuser('users','id','id',$_SESSION['uid']);
$pic= getuser('users','profilepicture','id',$_SESSION['uid']);

 $img="../users/default/profile.jpg";

if($pic=='')
{
$pic=$img;
}
else
{
$pic="../users/".$id."/images/".$pic;
}
?>
    <table width="100%" border="0" bgcolor="black" cellspacing="0" cellspacing="0">
<tr>
  <td width=7% align='center' bgcolor="white"><?php echo"<img src='".$pic."' width=50 height=50>";?></td>
  <td valign='center' ><table width="100%" border="0" cellspacing="0" cellspacing="0">
<tr>
  <td><a href='profile2.php?user=<?php echo $u;?>'><font size="3" color='white'><b>Your Profile</b></font></a></td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
<tr>
  <td width="100%" align="center"><table border=0 width="100%" >
      <tr>
        <td style="background:#000;opacity:0.8;border-radius:5px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='search.php'><font size="3" color='white'><b>Search</b></font></a> </td>
      </tr>
      <tr>
        <td style="background:#000;opacity:0.8; border-radius:5px;" >&nbsp;&nbsp;<font size="3" color='orange'><b>Your Activity</b></font> </td>
      </tr>
      <tr>
        <td style="background:#000;opacity:0.8;border-radius:5px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='#'><font size="3" color='white'><b>Messages</b></font></a> </td>
      </tr>
      <tr>
        <td style="background:#000;opacity:0.8;border-radius:5px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='#'><font size="3" color='white'><b>Visitors</b></font></a> </td>
      </tr>
      <tr>
        <td style="background:#000;opacity:0.8;border-radius:5px;">&nbsp;&nbsp;<font size="3" color='orange'><b>Account</b></font> </td>
      </tr>
      <tr>
        <td style="background:#000;opacity:0.8;border-radius:5px;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='#'><font size="3" color='white'><b>Setting</b></font></a> </td>
      </tr>
      <tr>
        <td style="background:#000;opacity:0.8;border-radius:5px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='logout.php'><font size="3" color='white'><b>Log Out</b></font></a> </td>
      </tr>
      <tr>
        <td style="background:#000;opacity:0.8;border-radius:5px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='#'><font size="3" color='white'><b>Go to full site</b></font></a> </td>
      </tr>
    </table>
  </td>
</tr>
<tr>
  <td bgcolor="green" align="center"><font color='white' size="3"> Copyright &copy; 2013, Vin Ltd. All Rights Reserved</font> </td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
</body>
</html>
