<?php
session_start();
?>
<?php
include('check.php');
include('config.php');

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


<title>Make Friends</title>
</head>

<body>

<div class="container">

<?php include('header.php')?>

  <div class="content">
  
  
    
	<table width="100%" border="0" cellspacing="0" cellpadding="0">

	
	
	<tr><td align="center">
	<p><font size="3" color='white'><b> Make Friends </b></font></p>
	</td></tr>
	
		<tr><td align="left">
	<hr>
	</td></tr>
	

	
		<tr><td align="center">
		

<table align='center' border='0' width=100%><tr><td>

<?php

$sql="SELECT * FROM  users WHERE username !='".$_SESSION['username']."' AND username!='NULL'";
$res=mysql_query($sql) or die(mysql_error());

echo "<table width=100% cellspacing=0 cellpadding='0' align='center' border=0>";


if(mysql_num_rows($res)>0)
{
echo"<tr><td bgcolor='black' colspan=3>&nbsp;</td></tr>";

while($row=mysql_fetch_assoc($res))
{

$frie=mysql_query("SELECT * FROM friend WHERE userone='".$_SESSION['username']."' AND usertwo='".$row['username']."' OR usertwo='".$_SESSION['username']."' AND userone='".$row['username']."' ");
if(mysql_num_rows($frie)!=1)
{

$from_query=mysql_query("SELECT id FROM friend_req WHERE fromm='".$row['username']."' AND too='".$_SESSION['username']."'") or die(mysql_error());
$to_query=mysql_query("SELECT id FROM friend_req WHERE fromm='".$_SESSION['username']."' AND too='".$row['username']."'") or die(mysql_error());

if(mysql_num_rows($to_query)==1)
{
$send= "<a href='findaction.php?action=cancel&user=".$row['username']."' ><font size=2 color='green'>Cancel Request</font></a>";

}
else
{
$send="<a href='findaction.php?action=send&user=".$row['username']."' ><font size=2 color='green'>Send Friend Request To <font color='orange'><b>".ucfirst($row['username'])."</b></font></font></a>";

}

echo"<tr><td bgcolor='white'><font size=2 color='black'>&nbsp;&nbsp;<font size=2><a href='profile3.php?view=info&user=".$row['id']."'><b>".$row['username']."</b></font></a></td>   <td bgcolor='white'><font size=2 color='black'>&nbsp;&nbsp;&nbsp;<font size=2 color='green'><b>".$send."</b></font></a></td></tr>";
echo "<tr><td colspan=3><hr></td></tr>";
}




}
echo"<tr><td bgcolor='black' colspan=3>&nbsp;</td></tr>";

}
else
{
echo"<tr><td colspan='2' align='center'><font size=2>No Online Users</font></td></tr>";
}

echo "</table>";
?>



</td></tr></table>
		
		
		
		

	</td></tr>
	
	
	
		
	</table>
 
  
        </div>
  <div class="footer" align="center">
    <p><?php include("footer.php");?></p>
    <!-- end .footer --></div>
  <!-- end .container --></div>
  
 
</body>
</html>