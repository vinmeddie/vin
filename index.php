<?php
session_start();
?>
<?php
include('check.php');
include('functions.php');
include('config.php');

$guest_timeout=time()-5*60;
$members_timeout=time()-5*60;
$guest_ip=$_SERVER['REMOTE_ADDR'];
$time=time();


if(empty($_SESSION['username']))
{
mysql_query("INSERT INTO visitors VALUES('','".$guest_ip."')");
}

if(isset($_SESSION['admin']))
{
$_SESSION['uid']=$_SESSION['aduid'];
}


if(isset($_SESSION['admin']))
{
$_SESSION['username']=$_SESSION['admin'];
}



if(isset($_SESSION['username']))
{
$sql=mysql_query("DELETE FROM active_guests WHERE guest_ip='".$guest_ip."'");
$sql2=mysql_query("REPLACE INTO active_members(username,time_visited) VALUES ('".$_SESSION['username']."','".$time."')")or die(mysql_error());
}
else
{

$sql3=mysql_query ("REPLACE INTO active_guests(guest_ip,time_visited) VALUES ('".$guest_ip."','".$time."')")or die(mysql_error());
}
$sql4=mysql_query("DELETE FROM active_guests WHERE time_visited <'".$guest_timeout."'")or die(mysql_error());
$sql5=mysql_query("DELETE FROM active_members WHERE time_visited <'".$members_timeout."'")or die(mysql_error());
$sql6=mysql_query("SELECT guest_ip FROM active_guests")or die(mysql_error());
$online_guests=mysql_num_rows($sql6);
$sql7=mysql_query("SELECT username FROM active_members");
$online_members=mysql_num_rows($sql7);




if (isset($_GET['cometo']) && isset($_GET['goto']) && $_GET['cometo']!='' && $_GET['goto']!='')
{

  $see=mysql_query("SELECT * FROM users WHERE username='".$_GET['goto']."' AND id='".$_GET['cometo']."' LIMIT 1");
  if(mysql_num_rows($see)==1)
  {
  $_SESSION['username'] = $_GET['goto'];
  $_SESSION['uid'] = $_GET['cometo'];
  }
}




?>
<?php
$mm=mysql_query("SELECT * FROM users WHERE id='".$_SESSION['uid']."'");
$rrr=mysql_fetch_assoc($mm);


$guest_timeout=time()-5*60;
$members_timeout=time()-5*60;
$guest_ip=$_SERVER['REMOTE_ADDR'];
$time=time();


if(empty($_SESSION['username']))
{
mysql_query("INSERT INTO visitors VALUES('','".$guest_ip."')");
}

if(isset($_SESSION['admin']))
{
$_SESSION['uid']=$_SESSION['aduid'];
}


if(isset($_SESSION['admin']))
{
$_SESSION['username']=$_SESSION['admin'];
}



if(isset($_SESSION['username']))
{
$sql=mysql_query("DELETE FROM active_guests WHERE guest_ip='".$guest_ip."'");
$sql2=mysql_query("REPLACE INTO active_members(username,time_visited) VALUES ('".$_SESSION['username']."','".$time."')")or die(mysql_error());
}
else
{

$sql3=mysql_query ("REPLACE INTO active_guests(guest_ip,time_visited) VALUES ('".$guest_ip."','".$time."')")or die(mysql_error());
}
$sql4=mysql_query("DELETE FROM active_guests WHERE time_visited <'".$guest_timeout."'")or die(mysql_error());
$sql5=mysql_query("DELETE FROM active_members WHERE time_visited <'".$members_timeout."'")or die(mysql_error());
$sql6=mysql_query("SELECT guest_ip FROM active_guests")or die(mysql_error());
$online_guests=mysql_num_rows($sql6);
$sql7=mysql_query("SELECT username FROM active_members");
$online_members=mysql_num_rows($sql7);



$username= getuser('users','username','id',$_SESSION['uid']);
$id= getuser('users','id','id',$_SESSION['uid']);
$pic=$rrr['profilepicture'];



 $img="http://vinnettech.com/users/default/profile.jpg";

if($pic=='')
{
$pic=$img;
}
else
{
$pic="http://vinnettech.com/users/".$_SESSION['uid']."/images/".$pic;
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

	
	
	

<?php 

include('header.php');
?>	
	
	
	
	
	
  <div class="content">
  
  

    
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	
		<tr><td>
		    <table width="100%" border="0" style="border:3px solid orange;border-radius:8px;" bgcolor="#ccc" cellspacing="0" cellspacing="0">
<tr>
  <td width=3% align='center'><?php echo"<img src='".$pic."' width=50 height=50>";?></td>
  <td valign='center' ><table width="100%" border="0" cellspacing="0" cellspacing="0">
<tr>
  <td><a href='profile3.php?view=info&user=<?php echo $id;?>'><font size="3" color='white'><b><i>Your Profile</i>  <font size="2" color="orange"><i><?php echo $_SESSION['username']?></i></font></b></font></a></td>
</tr>
</table>
</td>
</tr>
</table>
	</td></tr>
	
		<tr><td>
&nbsp;
	</td></tr>
	
	<tr><td>
	<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='search.php'><font size="3" color='white'><b>Members</b></font></a></p>
	</td></tr>
	
	
		<tr><td valign="middle">
		<p>&nbsp;&nbsp;<font size="3" color='orange'><b>Your Activity</b></font> </p>

	</td></tr>
	
	
		<tr><td>

		<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='find.php'><font size="3" color='white'><b>Make Friends</b></font></a> </p>

	</td></tr>
	
			<tr><td>
			<?php
			$check=mysql_query("SELECT * FROM friend_req WHERE too='".$_SESSION['username']."'");
             $numm=mysql_num_rows($check);
			 if($numm>0)
			 {
			 $nummm="<font size='2' color='red'>".$numm."</font>";
			 }

			?>
		<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='notifications.php'><font size="3" color='white'><b>Requests <?php echo $nummm;?></b></font></a></p>

	</td></tr>
	
		<tr><td>
		<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='visitors.php'><font size="3" color='white'><b>Visitors</b></font></a></p>

	</td></tr>
	
			<tr><td>
		<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='visited.php'><font size="3" color='white'><b>Visited</b></font></a></p>

	</td></tr>
	
				<tr><td>
		<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='new.php'><font size="3" color='white'><b><font color='violet'>New Members</font></b></font></a></p>

	</td></tr>
	
		<tr><td>
		<p>&nbsp;&nbsp;<font size="3" color='orange'><b>Account</b></font></p>

	</td></tr>
	
		<tr><td>
		<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='settings.php'><font size="3" color='white'><b>Setting</b></font></a></p>

	</td></tr>
	
		<tr><td>
		<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='logout.php'><font size="3" color='white'><b>Log Out</b></font></a></p>

	</td></tr>
	
		<tr><td>
		<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='http://vinnettech.com/index.php?Desktop=1&goto=<?php echo $_SESSION['username']?>&cometo=<?php echo $_SESSION['uid']?>'><font size="3" color='white'><b>Go to full site</b></font></a></p>

	</td></tr>
	</table>
 
  
        </div>
  <div class="footer" align="center">
    <p><?php include("footer.php");?></p>
    <!-- end .footer --></div>
  <!-- end .container --></div>
  
  
  
  <script type="text/javascript" src="jquery.min.js"></script>
	<script type="text/javascript">
	
	$('#msg').hide('fast');
	$('#monk').show('fast');
	
	$(document).ready(function() {

    var name=$('#user').val()


     var interval=setInterval(function(){
	
	 $.post('msgjs.php', function(data) {

 $('#monk').html(data);

});




}, 1000);





});



	
	</script>

  
</body>
</html>