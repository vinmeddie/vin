<?php
session_start();
?>
<?php
include('check.php');
include('functions.php');
include('config.php');


?>
<?php
$username= getuser('users','username','id',$_SESSION['uid']);
$id= getuser('users','id','id',$_SESSION['uid']);
$pic= getuser('users','profilepicture','id',$_SESSION['uid']);


 $img="http://vinnettech.com/users/default/profile.jpg";

if($pic=='')
{
$pic=$img;
}
else
{
$pic="http://vinnettech.com/users/".$id."/images/".$pic;
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
	<p><font size="3" color='white'><b>
	<?php
	$sqol="SELECT * FROM users WHERE id='".$_GET['user']."' LIMIT 1";
$reso=mysql_query($sqol) or die(mysql_error());
$y=mysql_fetch_assoc($reso);

$u=$y['username'];
$idx=$y['id'];
$d=$y['date_activated'];
$e=$y['email'];
$f=$y['fname'];
$l=$y['lname'];
$ab=$y['aboutme'];
$g=$y['gender'];
$pic=$y['profilepicture'];
//$de=$row['dateofbirth'];
$cou=$y['country'];
$state=$y['state'];

$tt=$y['date_activated'];
	$posttime=strtotime($tt);
$pasttime=time()-$posttime;

/////time

switch(1)
{
  case($pasttime < 60):
  $count=$pasttime;
  if($count==0)
  {
  $count='Just now';
  }
  elseif($count==1)
  {
  $suf='second ago';
  }
  else
  {
  $suf='seconds ago';
  }
  break;
  
   case($pasttime>60 && $pasttime < 3600):
  $count=floor($pasttime/60);
  
  if($count==1)
  {
  $suf='minute ago';
  }
  else
  {
  $suf='minutes ago';
  }
  break;
  
     case($pasttime>3600 && $pasttime < 86400):
  $count=floor($pasttime/3600);
  
  if($count==1)
  {
  $suf='hour ago';
  }
  else
  {
  $suf='hours ago';
  }
  break;
  
      case($pasttime>86400 && $pasttime < 2629743):
  $count=floor($pasttime/86400);
  
  if($count==1)
  {
  $suf='day ago';
  }
  else
  {
  $suf='days ago';
  }
  break;
  
      case($pasttime>2629743 && $pasttime < 31556926):
  $count=floor($pasttime/2629743);
  
  if($count==1)
  {
  $suf='month ago';
  }
  else
  {
  $suf='months ago';
  }
  break;
  
      case($pasttime> 31556926):
  $count=floor($pasttime/31556926);
  
  if($count==1)
  {
  $suf='year ago';
  }
  else
  {
  $suf='years ago';
  }
  break;
  
  
}


 $img="http://vinnettech.com/users/default/profile.jpg";

if($pic=='')
{
$pic=$img;
}
else
{
$pic="http://vinnettech.com/users/".$_GET['user']."/images/".$pic;
}

	
	if($_SESSION['uid']==$_GET['user'])
	{
	echo "<table ><tr><td width=3% align='center'><img src='".$pic."' width=50 height=50></td><td>Your Profile</td></tr></table>";
	}
	else
	{
	echo "<table><tr><td width=3% align='center'><img src='".$pic."' width=50 height=50></td><td>".ucfirst(strtolower($y['username']))."'s Profile </td>
	
	<td valign='middle' align='left'>
	";
	
	
	
	                       
  //friend request
  echo "<table>";
  if($user!=$_SESSION['username'])
{
$check_friend_query=mysql_query("SELECT id FROM friend WHERE userone='".$_SESSION['username']."' AND usertwo='".$y['username']."' OR userone='".$y['username']."' AND usertwo='".$_SESSION['username']."'");
if(mysql_num_rows($check_friend_query)==1)
{
echo "<tr><td><a href='#' ><font size=2 color='green'>Already Friends</font></a> | <a href='action.php?action=unfriend&user=".$y['username']."' ><font size=2 color='grey'>Unfriend ".$user."</font></a></td></tr>";
}
else
{
//$$from_query=mysql_query("SELECT id FROM friend WHERE userone='".$_SESSION['username']."' AND usertwo='".$user."' OR userone='".$user."' AND usertwo='".$_SESSION['username']."'");

$from_query=mysql_query("SELECT id FROM friend_req WHERE fromm='".$y['username']."' AND too='".$_SESSION['username']."'") or die(mysql_error());
$to_query=mysql_query("SELECT id FROM friend_req WHERE fromm='".$_SESSION['username']."' AND too='".$y['username']."'") or die(mysql_error());
if(mysql_num_rows($from_query)==1)
{
echo "<tr><td><a href='index.php' ><font size=2 color='green'>Ignore Friend Requset</font></a> <font color='green'>|</font> <a href='action.php?action=accept&user=".$y['username']."' ><font size=2 color='grey'>Accept Friend Request</font></a></td></tr>";

}
elseif(mysql_num_rows($to_query)==1)
{
echo "<tr><td><a href='action.php?action=cancel&user=".$y['username']."' ><font size=2 color='green'>Cancel Request</font></a></td></tr>";

}
else
{
echo "<tr><td><a href='action.php?action=send&user=".$y['username']."' ><font size=2 color='green'>Send Friend Request To <font color='orange'><b>".ucfirst($y['username'])."</b></font></font></a></td></tr>";

}

}
}
  //friend request
echo "</table>";
	
	
	
	
	
	echo "</td>
	
	</tr></table>";
	}
	?>
	
	</b></font></p>
	</td></tr>
	
		<tr><td align="left">
	<hr>
	</td></tr>
	
		<tr>
		<td align="left">
		<table><tr>
		
		<td>
		<?php 
		if(isset($_GET['view']) && $_GET['view']=='info')
		{
		echo '<a href="profile3.php?view=info&user='.$idx.'"><font color="orange"><b><i>Personal Information</i></b></font></a>';
		}
		else
		{
		echo '<a href="profile3.php?view=info&user='.$idx.'"><font color="white"><b><i>Personal Information</i></b></font></a>';
		}
		?>
		</td> 
		
		
		<td>&nbsp;</td> 
		<td>
	
		<?php
				if(isset($_GET['view']) && $_GET['view']=='photos')
		{
		echo '<a href="profile3.php?view=photos&user='.$idx.'"><font color="orange"><b><i>Photos</i></b></font></a>';
		//echo '<font color="orange"><b><i>Photos</i></b></font>';
		
		}
		else
		{
		echo '<a href="profile3.php?view=photos&user='.$idx.'"><font color="white"><b><i>Photos</i></b></font></a>';
		//echo '<font color="white"><b><i>Photos</i></b></font>';
		
		}
		?>
		
		
		</td> 
		
		
		<td>&nbsp;</td> 
		<td>
		
		<?php
						if(isset($_GET['view']) && $_GET['view']=='others')
		{
		echo '<a href="profile3.php?view=others&user='.$idx.'"><font color="orange"><b><i>Others</i></b></font></a>';
		}
		else
		{
		echo '<a href="profile3.php?view=others&user='.$idx.'"><font color="white"><b><i>Others</i></b></font></a>';
		}
		?>
		</td>
		</tr>
		
		
		</table>
	</td>
	</tr>
	
	<tr><td><hr></td></tr>
	
	<?php if(isset($_GET['view']) && $_GET['view']=='photos')
	{
	?>
			<tr>
		<td align="left">
		<table><tr>
		<td>
		
		
		
		
		
		

<table width="100%" border="0">
  <tr>

	
    <td width="100%" valign="top"><br><table width="100%" border="0">
      

	  <tr>
        <td>
		


		
<div class="bodyy">  
<div class="title_bar">  

<table>
<tr><td align='center'><a href="profile3.php?view=photos&user=<?php echo $idx;?>">Photos</a></td>
<td align='center'><a href="create.php?view=photos&user=<?php echo $idx;?>">Create Album</a></td>
<td align='center'><a href="upload.php?view=photos&user=<?php echo $idx;?>">Upload Photos</a></td></tr>
</table>

</div>

<div id="con">

<?php
if(isset($_GET['album']))
{
$al=$_GET['album'];
$sql15="SELECT * FROM album WHERE name='".$al."' AND user='".$_SESSION['uid']."'";
$res15=mysql_query($sql15) or die(mysql_error());
if(mysql_num_rows($res15)>=1)
{
?>

<div id="con">

<?php


$sql1="SELECT * FROM photos WHERE album='".$al."' AND user='".$_SESSION['uid']."' LIMIT 6";
$res1=mysql_query($sql1) or die(mysql_error());
if(mysql_num_rows($res1)>=1)
{
while($select=mysql_fetch_assoc($res1))
{

$ab_name=$select['name'];
$p=$select['url'];

?>


<div id="view_box" align='center'>
<a href='#'><img src="http://vinnettech.com/users/<?php echo $_SESSION['uid']."/pictures/".$_GET['album']."/".$p;?>" width=10 height=10><br>
<b><?php echo $ab_name?></b>

<div style="padding:3px;"></div>
<div style="background-color:green;padding:5px;border-radius:5px;"> <a href='viewimage.php?album=<?php echo $_GET['album']?>&view=delete&&id=<?php echo $select['id']?>'>Delete</a>  <font color='white'>|</font></div>

</div>

<?php
}

}
else
{
echo "
<div id='error_box'>
No photos available.
</div>
";
}

?>

</div>


<?php
}
else
{
echo "<div id='error_box'>The album specified does not exist</div>";
}
}
?><div class="clear"></div>

</div>


</div>
		
		
		</td>
      </tr>

	  <tr>
	  <td>
	
				
                </td>
              </tr>
				
				</table>
		  </td>
	  </tr>
    </table>


	
 </td>
	  </tr>
</table>
		
		
		
		
		
		
		
		
		
		
		</td>
		</tr></table>
	</td>
	</tr>
	
	<?php
	}elseif(isset($_GET['view']) && $_GET['view']=='others')
	{
	?>
	
			<tr>
		<td align="left">
		<table><tr>
		<td>Others</td>
		</tr></table>
	</td>
	</tr>	
	<?php
	}
	else
	{
	?>
				<tr>
		<td align="left">
		<table><tr>
		<td>
		

		
		<table width="100%" border="0">
                                        <tr>
                                          <td>
										<p><font size="2" color="orange"><b>Username</b></font></p>
										  <p><i><?php echo ucfirst(strtolower($u))?></i></p>
										  
									      <p><font size="2" color="orange"><b>Full Name</b></font></p>
										  <p><i><?php echo ucfirst(strtolower($f))." ".ucfirst(strtolower($l))?></i></p>
										  
										   <p><font size="2" color="orange"><b>About</b></font></p>
										  <p><i><?php echo ucfirst(strtolower($ab))?></i></p>
										  
										  <p><font size="2" color="orange"><b>State</b></font></p>
										  <p><i><?php echo ucfirst(strtolower($state))?></i></p>
										  
										  <p><font size="2" color="orange"><b>Country</b></font></p>
										  <p><i><?php echo ucfirst(strtolower($cou))?></i></p>
										  
										  <p><font size="2" color="orange"><b>Registered</b></font></p>
										  <p><i><?php echo $count." ".$suf?></i></p>
										  
										  
										  </td>
                                        </tr>
                                      </table>
		
		
		</td>
		</tr></table>
	</td>
	</tr>
	<?php
	}
	?>
	
	
		
	</table>
 
  
        </div>
  <div class="footer" align="center">
    <p><?php include("footer.php");?></p>
    <!-- end .footer --></div>
  <!-- end .container --></div>
  
 
</body>
</html>