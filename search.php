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
<link rel='stylesheet' type='text/css' href='members.css'>
<link rel='stylesheet' type='text/css' href='header.css'>


<title>VinNetTech</title>
</head>

<body>

<div class="container">

<?php include('header.php')?>


  <div class="content">
  
  
  <div id="profile" style="display:none;"></div>
<div id="close">X</div>

<div id="userinfo" style="display:none;">

</div>
<div id="loader" align='center'>

rrrrr


</div>

    
	<table width="100%" border="0" cellspacing="0" cellpadding="0">

	
	<tr><td align="center">
	<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='http://m.vinnettech.com/search.php'><font size="3" color='white'><b>Search</b></font></a></p>
	</td></tr>
	
		<tr><td align="center">
<form action='search3.php?hide=true' name='sa' method='post'> <br/><input class="input" type='text' id='on' autocomplete="off" placeholder="search for a user" name='search'/><input class="search" type='submit' id='two' name='s' value='Search'/>  </form>
<div id="sea" style="
display:none;border:1px solid green;
border-radius:5px;
text-align:left;height:auto;
position:absolute;
left:10%;

width:240px;background:#ededed;cursor:pointer;

color:#fff;


box-shadow:0 0 20px green;
-webkit-box-shadow:0 0 20px green;
-moz-box-shadow:0 0 20px green;
-ms-box-shadow:0 0 20px green;
-o-box-shadow:0 0 20px green;

border:1px solid #fff;
"></div>
<div id='x' style='
border-radius:5px;
top:17%;
cursor:pointer;
width:30px;
background:#ccc;
color:#fff;
text-align:center;
font-size:16px;
font-weight:bold;
box-shadow:0 0 5px #777;
-webkit-box-shadow:0 0 5px #777;
-moz-box-shadow:0 0 5px #777;
-ms-box-shadow:0 0 5px #777;
-o-box-shadow:0 0 5px #777;
position:absolute;
right:50%;
border:1px solid #fff;
display:none;
'>X</div>
	</td></tr>
	
	
	<tr><td align="left">
	
<?php 
$sql = mysql_query("SELECT id,date_activated,country,username,email FROM users WHERE username!='NULL' AND username!='".$_SESSION['username']."' ORDER BY rand() LIMIT 10"); 
$i = 0;
// Establish the output variable
$dyn_table = '<table border="0" cellpadding="15">';
while($row = mysql_fetch_array($sql)){ 
    
    $id = $row["id"];

    $member_name = $row["username"];
	 	$tt=$row['date_activated'];
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
        $dyn_table .= '<tr><td><a class="preset_text" id="'.$id.'" href="profile3.php?view=info&user='.$id.'"><font color="orange">' . ucfirst(strtolower($member_name)) . '</font><font size="2" color="white"><br><i>Lives in '.$row["country"].'<br> Joined '.$count.' '.$suf.'</i></font></td>';
    } else {
        $dyn_table .= '<td><a class="preset_text" id="'.$id.'" href="profile3.php?view=info&user='.$id.'"><font color="orange">' . ucfirst(strtolower($member_name)) . '</font><font size="2" color="white"><br><i>Lives in '.$row["country"].'<br> Joined '.$count.' '.$suf.'</i></font></td>';
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
  
  
  <script type="text/javascript" src="jquery.min.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
var name=$('#on').val()
	
$('#on').keyup(function(){

	$.post('search2.php',{search:sa.on.value}, function(data) {
$('#sea').html(data).show();
$('#x').show();


});
	
		
    $("#x").click(function(){
    $("#sea").hide("slow");
	$("#x").hide("slow");
  });
  
	


});



 	$('.preset_text').click(function(){	
	var target = $(this).attr("id");


	

	
$('#loader').show();	
	 $.post('profil3js.php',{n:target}, function(data) {

$('#userinfo').html(data).show();
$('#close').show();


$('#loader').hide();	


});






    $("#close").click(function(){
    $("#userinfo").hide("slow");
	$("#close").hide("slow");
	});

return false;

});



	});
	</script>

</body>
</html>