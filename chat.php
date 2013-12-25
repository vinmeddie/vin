<?php
session_start();
?>
<?php
include('check.php');
include('config.php');

$mess=mysql_real_escape_string(trim($_POST['m']));

if(isset($_POST['post']))
{
if($mess!='')
{
$rr=mysql_query("SELECT * FROM m_chat WHERE post='".$mess."'");
if(mysql_num_rows($rr)>'0')
{
header('location:chat.php?succ=no');
}
else
{
mysql_query("INSERT INTO m_chat VALUES('','".$mess."','".$_SESSION['uid']."',now())") or die(mysql_error());
header('location:chat.php?succ=yes');
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


<title>Chat</title>
</head>

<body>

<div class="container">
 
 <?php include('header.php')?>
 
  <div class="content">
  
  
    
	<table width="100%" border="0" cellspacing="0" cellpadding="0">

	<?php
	
	$limit='10';
	
			if(isset($_POST['go']))
		{
		
		if($_POST['op']=='c')
		{
		$limit='10';
		}
		else
		{
		$limit=$_POST['op'];
		}
		
		}
		
		
	?>
	
	<tr><td align="left">
	
	<?php 
	if(isset($_GET['succ']) && $_GET['succ']=='yes')
	{
	?>
	<p><font color="red" size="2"> <b>Post Added Successfully</b> </font></p>
	<?php
	}
	?>
	
		<?php 
	if(isset($_GET['succ']) && $_GET['succ']=='no')
	{
	?>
	<p><font color="red" size="2"> <b>Post Already Exists</b> </font></p>
	<?php
	}
	?>
	
	<form action="" method="post">
	<p><textarea rows="3" cols="40" name='m' id="mk"></textarea></p>
	
	<p><input class="search" type='submit' value='Post' name="post"></p>
	</form>
	</td></tr>
	
		<tr><td align="left">
	<hr>
	</td></tr>
	

	
		<tr><td align="center">
		

		
		<?php
		
		
		$sql = mysql_query("SELECT * FROM m_chat ORDER BY id DESC ") or die(mysql_error()); 
$i = 0;
// Establish the output variable
$dyn_table = '<table border="1" width="100%" cellpadding="15" align="left">';
while($r = mysql_fetch_assoc($sql))
{ 
  
  $uuser=mysql_query("SELECT * FROM users WHERE id='".$r['user']."'");
  $eu=mysql_fetch_assoc($uuser);
  
    $member_name = $eu["username"];
	
	
	    $post = $r["post"];
	 	$id=$r['id'];
			 	$user=$r['user'];
		$tt=$r['date'];
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

  $rrk=mysql_query("SELECT * FROM m_like WHERE post_id='".$id."' AND user='".$_SESSION['uid']."'");
if(mysql_num_rows($rrk)=='0')
{
$like='<a href="likes.php?user='.$_SESSION['uid'].'&id='.$id.'&st=like"><font size="2" color="green">Like</font></a>';
}
else
{
$like='<a href="likes.php?user='.$_SESSION['uid'].'&id='.$id.'&st=unlike"><font size="2" color="green">UnLike</font></a>';
}


  $rrkm=mysql_query("SELECT * FROM m_like WHERE post_id='".$id."'");
if(mysql_num_rows($rrkm)=='1')
{
$num='<font size="2" color="green">'.mysql_num_rows($rrkm).' person</font>';
}
else
{
$num='<font size="2" color="green">'.mysql_num_rows($rrkm).' persons</font>';
}
  
  
    $rrkk=mysql_query("SELECT * FROM m_comments WHERE post_id='".$id."'");
if(mysql_num_rows($rrkk)=='0')
{
$com="<a href='comment.php?id=".$id."'><font color='green' size='2'>Comment</font></a>";
}
elseif(mysql_num_rows($rrkk)=='1')
{
$com="<a href='comment.php?id=".$id."'><font color='green' size='2'>".mysql_num_rows($rrkk)." Comment</font></a>";
}
elseif(mysql_num_rows($rrkk)>'1')
{
$com="<a href='comment.php?id=".$id."'><font color='green' size='2'>".mysql_num_rows($rrkk)." Comments</font></a>";
}

if($r['user']==$_SESSION['uid'])
{
$del="<a href='likes.php?st=del&id=".$id."'><font color='green' size='2'>Delete</font></a>";
}
	

        echo'<tr><td><a href="profile3.php?view=info&user='.$user.'"><font color="orange">' . ucfirst(strtolower($member_name)) . '</font>  </a> <br> <font size="2" color="white"><i>'.$post.'</i></font> <br> <font size="2" color="grey">'.$count.' '.$suf.'</font><br>'.$num.' '.$like.' &nbsp; '.$com.'&nbsp; '.$del.'</td></tr>';
        echo '<tr><td><hr></td></tr>';

}
echo'</table>';

		
		
		
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