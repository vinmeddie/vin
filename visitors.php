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


<title>VinNetTech</title>
</head>

<body>

<div class="container">

<?php include('header.php')?>

  <div class="content">
  
  
		<?php
		//get visitors
$nn=mysql_query("SELECT * FROM pofilevisitors WHERE visited='".$_SESSION['uid']."'");
$p=mysql_num_rows($nn);
if($p=='1')
{
$mm=$p." Visitor";
}
else
{
$mm=$p." Visitors";
}
//end get visitors
		
		?>
    
	<table width="100%" border="0" cellspacing="0" cellpadding="0">

	
	<tr><td align="left">
	<p><font size="3" color='white'><b>People Who Visited Your Profile [ <?php echo $mm;?> ]</b></font></p>
	</td></tr>
	
		<tr><td align="left">
	<hr>
	</td></tr>
	
		<tr><td align="center">
		

		
		<?php
		
		
		$sql = mysql_query("SELECT * FROM pofilevisitors WHERE visited='".$_SESSION['uid']."'"); 
$i = 0;
// Establish the output variable
$dyn_table = '<table border="0" cellpadding="15" align="left">';
while($row = mysql_fetch_array($sql)){ 
  
   

	$sql3 = mysql_query("SELECT * FROM users WHERE id='".$row["Visitor"]."' ORDER BY rand()");
	$r=mysql_fetch_assoc($sql3);
	 $id = $r["id"];
    $member_name = $r["username"];
	 	$tt=$r['date_activated'];
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
	
    
    if ($i % 4 == 0) { // if $i is divisible by our target number (in this case "3")
        $dyn_table .= '<tr><td><a class="preset_text" id="'.$id.'" href="profile3.php?user='.$id.'"><font color="orange">' . ucfirst(strtolower($member_name)) . '</font><font size="2" color="white"><br><i>Lives in '.$row["country"].'<br> Joined '.$count.' '.$suf.'</i></font></td>';
    } else {
        $dyn_table .= '<td><a class="preset_text" id="'.$id.'" href="profile3.php?user='.$id.'"><font color="orange">' . ucfirst(strtolower($member_name)) . '</font><font size="2" color="white"><br><i>Lives in '.$row["country"].'<br> Joined '.$count.' '.$suf.'</i></font></td>';
    }
    $i++;
}
$dyn_table .= '</tr></table>';

echo $dyn_table; 
		
		
		
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