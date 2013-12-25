<?php
session_start();
?>
<?php
include('check.php');
?>



<?php


$sqlxc="SELECT DISTINCT msgfrom FROM messages WHERE msgto='".$_SESSION['uid']."' AND status='unread' AND todelete='".$_SESSION['uid']."' ORDER BY msgid DESC";
$resxc=mysql_query($sqlxc) or die(mysql_error());
if(mysql_num_rows($resxc)>0)
{


echo "<table width='100%' align='center' border='0' cellspacing='0'>";

echo "<tr><td align='right' colspan='2'><div id='hidie'><a href='sendmsg.php'><font size='2'>Compose a New Message</font></a></div>&nbsp</td></tr>";


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


echo "<tr bgcolor='#ededed'><td align='left'> <font size=2>".ucfirst(strtolower($rows22['username']))." (".$num.") </font><br><font size=1 color='green'>".nl2br($rows2['msgcontent'])."</font></a><br><font size=1>".date("g:ia", strtotime($rows2['msgtime']))." (".$count." ".$suf.")</font></td> <td align='right'>".$sess."&nbsp;&nbsp;</td></tr>";
$color='2';
}
else
{
echo "<tr bgcolor='#fff'><td align='left'> <font size=2>".ucfirst(strtolower($rows22['username']))." (".$num.") </font><br><font size=1 color='green'>".nl2br($rows2['msgcontent'])."</font></a><br><font size=1>".date("g:ia", strtotime($rows2['msgtime']))." (".$count." ".$suf.")</font></td> <td align='right'>".$sess."&nbsp;&nbsp;</td></tr>";

$color='1';

}


}






echo "</table>";



echo "<br>";


}
else
{
echo "<table align='center' width='100%'>";
echo "<tr><td align='right'><a href='sendmsg.php'><font size='2'>Compose a New Message </font></a> &nbsp</td></tr>";
echo "<tr><td align='center'><hr style='color:green;'></td></tr>";
echo "<tr><td align='center'><font color=red size=2>No new messages</font></td></tr>";
echo "<tr><td align='center'>&nbsp;</td></tr>";
echo "<tr><td align='center'><font color=red size=2><a href='message.php'>click here to view older messages</a></font></td></tr>";
echo "<tr><td align='center'>&nbsp;</td></tr>";

echo "</table>";
}


?>

<script type="text/javascript" src="jquery.min.js"></script>
	<script type="text/javascript">
		$('#hidie').click(function() {
      
		$('#send').fadeIn();
		

return false;
});
	
	
	</script>

		