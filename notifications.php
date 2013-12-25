<?php
session_start();
?>
<?php
if(empty($_SESSION['uid']))
{
header('location:login.php');
exit();
}
include('functions.php');
include('config.php');


?>
<?php
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


<title>Requests</title>
</head>

<body>

<div class="container">

<?php include('header.php')?>

  <div class="content">
  
  

    
	<table width="100%" border="0" cellspacing="0" cellpadding="0">

	
	<tr><td align="center">
	<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='#'><font size="3" color='white'><b>Requests</b></font></a>
	<hr>
	</p>
	</td></tr>
	
	
	
	<tr><td align="left">
	

	
			
		<table align='left' width=100%><tr><td>


<?php
$perpage=5;


$rs=mysql_query("SELECT count(*) FROM friend_req WHERE too='".$_SESSION['username']."'");
$pages=ceil(mysql_result($rs,0)/$perpage);

if(isset($_GET['pn']))
{
$page=(int)$_GET['pn'];
}
else
{
$page=1;
}
$start=($page-1)*$perpage;

$sql="SELECT * FROM friend_req WHERE too='".$_SESSION['username']."' ORDER BY id DESC LIMIT $start,$perpage";
$res=mysql_query($sql) or die(mysql_error());
if(mysql_num_rows($res)>0)
{
echo "<table border=0 width=100% align='left' style='border:1px solid black;'><tr><td align='left' bgcolor='black'><font color='white'>Pages <b>".$page."</b> of <b>".$pages."</b></font></td></tr><tr><td>";
echo "<table border=0  width=100% align='left' style='border:1px solid black;'>";

while($row=mysql_fetch_assoc($res))
{

$from=$row['fromm'];




$sh="SELECT * FROM users WHERE username='".$from."' LIMIT 1";
$rh=mysql_query($sh) or die(mysql_error());
$rh=mysql_fetch_assoc($rh);




 $img="http://vinnettech.com/users/default/profile.jpg";

if($rh['profilepicture']=='')
{
$rh['profilepicture']=$img;
}
else
{
$rh['profilepicture']="http://vinnettech.com/users/".$rh['id']."/images/".$pic;
}



echo "<tr><td width=15%><img src='".$rh['profilepicture']."' ></td><td>&nbsp;</td>";

if($from=='NULL')
{
$from="Unknown";
echo "<td><font color=cyan size=2>".$from."</font></td></tr>";

}
else
{
echo "<td><font color=cyan size=2><a href='profile3.php?view=info&user=".$rh['id']."'>".$from."</a> </font></td></tr>";
}

}
echo "</td></tr></table>";
echo "<tr><td align='left' bgcolor='black'><font color='white'>Pages <b>".$page."</b> of <b>".$pages."</b></font></td></tr>";
echo "</td></tr></table>";


echo "<br>";

echo "<table border=0 align='left' style='border:1px solid black;'>";

if($page !=1)
{
$back=$_GET['pn']-1;
echo "<tr><td bgcolor='black' align='left'>&nbsp;<a href='notification.php?pn=".$back."'> <font size=2> BACK </font></a>&nbsp;</td>";
}

echo "<td bgcolor=''>";
if($pages>1)
{
for($x=1;$x<=$pages;$x++)
if($x==$page)
{

echo "<td align='left'><b><a style='border:#999 1px solid; background-color:black;' href='notification.php?pn=".$x."'> &nbsp;&nbsp;&nbsp;".$x." &nbsp;&nbsp;</a> </b></td>";
}
else
{

echo "<td align='left'><a href='notification.php?pn=".$x."'> ".$x."&nbsp;&nbsp; </a>&nbsp;&nbsp; </a></td>";
}
}
echo "</td>";

if($page !=$pages)
{
$next=$_GET['pn']+1;
echo "<td bgcolor='black' align='left'>&nbsp;<a href='notification.php?pn=".$next."'> <font size=2>NEXT </font></a>&nbsp;</td></tr><tr></tr>";
}

echo "</table>";

}
else
{
echo "<table align='center'><td align='left'><font color=red size=2>No Requests</font></td></tr>";
echo "</table>";

}


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