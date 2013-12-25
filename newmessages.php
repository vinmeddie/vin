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
  
  

    
	<table width="100%" border="0" cellspacing="0" cellpadding="0">

	
	<tr><td align="center">
	<p><font size="3" color='white'><b>New Messages</b></font></p>
	</td></tr>

		<tr><td align="left">
	<hr>
	</td></tr>
	
	<tr><td align="left">


	
	
	
	
	
	
	
	
	
	
	
	<?php


$sqlxc="SELECT DISTINCT msgfrom FROM messages WHERE msgto='".$_SESSION['uid']."' AND status='unread' AND todelete='".$_SESSION['uid']."' ORDER BY msgid DESC";
$resxc=mysql_query($sqlxc) or die(mysql_error());
if(mysql_num_rows($resxc)>0)
{


echo "<table width='100%' align='center' border='0' cellspacing='0'>";

$color='1';
while($rowk=mysql_fetch_assoc($resxc))
{

$msgfrom=$rowk['msgfrom'];



$sql2="SELECT * FROM users WHERE id='".$msgfrom."'";
$res2=mysql_query($sql2) or die(mysql_error());
$rows22=mysql_fetch_assoc($res2);

$sql="SELECT * FROM messages WHERE msgto='".$_SESSION['uid']."' AND msgfrom='".$msgfrom."' AND status='unread' AND todelete='".$_SESSION['uid']."' ORDER BY msgid DESC";
$res=mysql_query($sql) or die(mysql_error());
$rows2=mysql_fetch_assoc($res);
$msgto=$rows2['msgto'];
$msgid=$rows2['msgid'];
$msgcontent=$rows2['msgcontent'];


$sql20="SELECT * FROM messages WHERE msgto='".$_SESSION['uid']."' AND msgfrom='".$msgfrom."' AND status='unread' AND todelete='".$_SESSION['uid']."'";
$res20=mysql_query($sql20) or die(mysql_error());

if(mysql_num_rows($res20)>0)
{
$num=mysql_num_rows($res20);
}

$posttime=strtotime($rows2['msgtime']);
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


$sql4="SELECT * FROM  active_members WHERE username ='".$rows22['username']."'";
$res4=mysql_query($sql4) or die(mysql_error());
$cx=mysql_fetch_assoc($res4);

 if(mysql_num_rows($res4)>0)
   {
$sess="<font color='orange' size=2><i><b>Online</b></i></font>";
}
else
{
$sess="<font color=red size=2><i><b>Offline</b></i></font>";
}


if($color=='1')
{


echo "<tr bgcolor='#ededed'><td align='left'><a href='reply.php?msgid=".$msgid."&msgto=".$msgto."&msgfrom=".$msgfrom."'> <font size=2 color='black'><b>".ucfirst(strtolower($rows22['username']))." (".$num.") </b></font><br><font size='2' color='grey'><i>".nl2br($rows2['msgcontent'])."</i></font></a><br><font size='1' color='orange'><b><i>".date("g:ia", strtotime($rows2['msgtime']))." (".$count." ".$suf.")</i></b></font></td> <td align='right'>".$sess."&nbsp;&nbsp;</a></td></tr>";
$color='2';
}
else
{
echo "<tr bgcolor='#fff'><td align='left'><a href='reply.php?msgid=".$msgid."&msgto=".$msgto."&msgfrom=".$msgfrom."'> <font size=2 color='black'><b>".ucfirst(strtolower($rows22['username']))." (".$num.") </b></font><br><font size='2' color='grey'><i>".nl2br($rows2['msgcontent'])."</i></font></a><br><font size='1' color='orange'><b><i>".date("g:ia", strtotime($rows2['msgtime']))." (".$count." ".$suf.")</i></b></font></td> <td align='right'>".$sess."&nbsp;&nbsp;</a></td></tr>";

$color='1';

}


}






echo "</table>";



echo "<br>";


}
else
{
echo "<table align='left' width='100%'>";
echo "<tr><td align='center'><font color=red size=2>No new messages</font></td></tr>";
echo "<tr><td align='left'>&nbsp;</td></tr>";
echo "<tr><td align='left'><font color=red size=2><a href='message.php'>click here to view older messages</a></font></td></tr>";
echo "<tr><td align='left'>&nbsp;</td></tr>";

echo "</table>";
}

echo "<table align='left'><tr><td align='right' colspan='2'><div id='hidie'><a href='sendmsg.php'><font size='2'>Compose a New Message</font></a></div>&nbsp</td></tr></table>";

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


	});
	</script>

</body>
</html>