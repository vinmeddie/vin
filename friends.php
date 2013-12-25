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


<title>Friends</title>
</head>

<body>

<div class="container">

<?php include('header.php')?>

  <div class="content">
  
  
    
	<table width="100%" border="0" cellspacing="0" cellpadding="0">

	<?php
	
	$limit='5';
	
			if(isset($_POST['go']))
		{
		
		if($_POST['op']=='c')
		{
		$limit='5';
		}
		else
		{
		$limit=$_POST['op'];
		}
		
		}
		
		
	?>
	
	<tr><td align="left">
	<p><font size="3" color='white'><b><?php echo $limit;?> Top Friends</b></font></p>
	</td></tr>
	
		<tr><td align="left">
	<hr>
	</td></tr>
	
	<?php
	
$sqlk=mysql_query("SELECT * FROM friend WHERE userone='".$_SESSION['username']."' OR usertwo='".$_SESSION['username']."' ") or die(mysql_error());
$no=mysql_num_rows($sqlk);
	?>
	
		<tr><td align="center">
	<p>
	<form action='' method='post'>
	<select name='op' class="input">
	<option value="c">--Choose a Limit--</option>
	<?php
	for($i=1;$i<=$no;$i++)
	{
	echo "<option value=".$i.">".$i."</option>";
	}
	?>
	</select>
	
	<input class="search" type='submit' name='go' value='Go'></p>
	</form>
	</td></tr>
	
		<tr><td align="center">
		

		
		<?php
		
		
$sql=mysql_query("SELECT * FROM friend WHERE userone='".$_SESSION['username']."' OR usertwo='".$_SESSION['username']."' LIMIT $limit") or die(mysql_error());
$i = 0;
// Establish the output variable
$dyn_table = '<table border="0" cellpadding="15" align="left">';
while($r = mysql_fetch_array($sql)){ 
  
 $one=$r['userone'];
$two=$r['usertwo'];
$date=$r['time'];

if($one==$_SESSION['username'])
{
$user=$two;
}
else
{
$user=$one;
}
  
  $sh="SELECT * FROM users WHERE username='".$user."'";
$rhh=mysql_query($sh) or die(mysql_error());

$rh=mysql_fetch_assoc($rhh);
  
    $member_name = $rh["username"];
	    $id = $rh["id"];
	 	$tt=$rh['date_activated'];
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
	
    
    if ($i % 2 == 0) { // if $i is divisible by our target number (in this case "3")
        $dyn_table .= '<tr><td><a class="preset_text" id="'.$id.'" href="profile3.php?view=info&user='.$id.'"><font color="orange">' . ucfirst(strtolower($member_name)) . '</font><font size="2" color="white"><br><i>Lives in '.$rh["country"].'<br> Joined '.$count.' '.$suf.'</i></font></td>';
    } else {
        $dyn_table .= '<td><a class="preset_text" id="'.$id.'" href="profile3.php?view=info&user='.$id.'"><font color="orange">' . ucfirst(strtolower($member_name)) . '</font><font size="2" color="white"><br><i>Lives in '.$rh["country"].'<br> Joined '.$count.' '.$suf.'</i></font></td>';
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