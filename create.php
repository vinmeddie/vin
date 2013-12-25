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
<link rel='stylesheet' type='text/css' href='heeader.css'/>


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
	
	if($_SESSION['uid']==$_GET['user'])
	{
	echo "Your Profile";
	}
	else
	{
	echo ucfirst(strtolower($y['username']))."'s Profile";
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
		}
		else
		{
		echo '<a href="profile3.php?view=photos&user='.$idx.'"><font color="white"><b><i>Photos</i></b></font></a>';
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
<td align='center'><a href="upload.php?view=photos&user=<?php echo $idx;?>">Upload Photos</a></td></t

</table>

</div>







<div id="cont">
<h3>Create Album</h3>
<form method="post">

<?php
if(isset($_POST['name']))
{
$name=mysql_real_escape_string(strip_tags(trim($_POST['name'])));
if(empty($name))
{
 echo "<font size=2 color='red'>Please Enter an Album Name</font><br><br>";
}
else
{


$sql1="SELECT * FROM album WHERE name='".$name."' AND user='".$_SESSION['uid']."'";
$res1=mysql_query($sql1) or die(mysql_error());
if(mysql_num_rows($res1)>=1)
{
echo "<div id='album_error'><font size=2 color='red'>Album Already Exists</font></div><br><br>";
}
else
{
if(!file_exists("../users/".$_SESSION['uid']."/pictures"))
{
mkdir("../users/".$_SESSION['uid']."/pictures",0755);
}


if(!file_exists("../users/".$_SESSION['uid']."/pictures/".$name))
{
mkdir("../users/".$_SESSION['uid']."/pictures/".$name,0755);
}

$sql="INSERT INTO album VALUES('NULL','".$name."','".$_SESSION['uid']."')";
mysql_query($sql) or die(mysql_error());
echo "<font size=2 color='red'>Album Added Succesfully</font><br><br>";
}



}

}

?>

Album Name : <input type='text' name='name'> <input type='submit' value='create'>

</form>

</div>





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