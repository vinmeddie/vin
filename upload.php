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


<?php

$name=mysql_real_escape_string(strip_tags(trim($_POST['name'])));
$album=mysql_real_escape_string(strip_tags(trim($_POST['album'])));
$p=$_POST['pic'];

$sql14="SELECT * FROM album WHERE id='".$album."'";
$res14=mysql_query($sql14) or die(mysql_error());
 $e4=mysql_fetch_assoc($res14);
 $album=$e4['name'];
 
if(isset($_FILES['avi'])&& isset($name))
{

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
if(empty($name))
{
$errors[]="Please provide a Name";
}

if(empty($album))
{
$errors[]="Please choose an album";
}

if(empty($errors))
{



$sql1="SELECT * FROM photos WHERE url='".$file_name."' AND user='".$_SESSION['uid']."'";
$res1=mysql_query($sql1) or die(mysql_error());
if(mysql_num_rows($res1)>=1)
{
$up1="<div id='album_error'><font size=2 color='red'>Photo Already Exists</font></div>";

}

else
{
include("imgresize.php");

$sql="INSERT INTO photos VALUES('NULL','".$name."','".$album."','".$file_name."','".$_SESSION['uid']."')";
mysql_query($sql) or die(mysql_error());

if(!file_exists("../users/".$_SESSION['uid']."/pictures"))
{
mkdir("../users/".$_SESSION['uid']."/pictures",0755);
}

if(!file_exists("../users/".$_SESSION['uid']."/pictures/".$album))
{
mkdir("../users/".$_SESSION['uid']."/pictures/".$album,0755);
}


move_uploaded_file($file_tmp,'../users/'.$_SESSION['uid'].'/pictures/'.$album.'/'.$file_name );
vin('../users'.$_SESSION['uid'].'/pictures/'.$album.'/'.$file_name,'users/'.$_SESSION['uid'].'/pictures/'.$album.'/ggg.jpg',400,200);

//move_uploaded_file($file_tmp,'images/userphotos/'.$file_name );
$up= "<font size=2 color='red'>Photo Uploaded Successfully</font><br><br>";
//header('location:profile.php');
}




}
}

 
 
 
$sql222="SELECT * FROM album WHERE user='".$_SESSION['uid']."'";
$res222=mysql_query($sql222) or die(mysql_error());
if(mysql_num_rows($res222)<1)
{
echo "
<div align='center' id='error_upload_box'>
You first have to create an <a href='create.php'><b>Album</b></a> before uploading a picture.
</div>
";
}

else
{
$sql2224="SELECT * FROM photos WHERE user='".$_SESSION['uid']."'";
$res2224=mysql_query($sql2224) or die(mysql_error());
if(mysql_num_rows($res2224)>=20)
{

echo "<div id='album_erroru' align='center'><font size=2 color='red'><br><br>Sorry you have reached your maximum uploads<br><b>NB</b> Only twenty (20) uploads are allowed since this is a trial version</font></div>";
}
else
{
?>





<div id="cont">
<h3>Upload Photos</h3>
<form action='' method='POST' enctype='multipart/form-data'>

<font color='red'>
<?php echo $up1;?>
<?php echo $up;?>

<?php if(isset($errors)){foreach($errors as $error)
{
echo $error.'<br>';

}}?></font><br>

<table border=0><tr><td valign='top'>
<font color='black'>Name : </td><td></font> <input type='text' name='name'> <br><br>
</td></tr>
<tr><td valign='top'>
Select Album :
</td><td>
<?php
$sql2="SELECT * FROM album WHERE user='".$_SESSION['uid']."'";
$res2=mysql_query($sql2) or die(mysql_error());
if(mysql_num_rows($res2)<1)
{
$mm="<font color='red'>No Albums</font>";
}
else
{

echo "<select name='album'>";
echo "<option value='choose a name'>choose a name</option>";
while($select=mysql_fetch_assoc($res2))
{




echo "<option value=".$select['id'].">".ucfirst(strtolower($select['name']))."</option>";
}
echo "</select>";
//echo "<input type='radio' value='".$select['name']."' name='album'>".ucfirst(strtolower($select['name']))."<br>";


}

?>

<?php echo $mm;?>
<br><br>
<tr><td valign='top'>
Select Photo : </td><td><input type='file' name='avi'><br><br>
</td></tr>
<tr><td colspan=2 align='right'>
<input type='submit' value='Upload' name='upload'>
</td></tr></table>
</form>

</div>

<?php }} ?>

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