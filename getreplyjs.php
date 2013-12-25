<?php session_start();?>
<table border='0' align="left" id='register' align='center' cellspacing=0 width=100%>
<p id="ee" style="display:none;"><font size='2' color='red'>Deleting message....Please wait....</font></p>
<?php
include('config.php');

$msgid=$_POST['msgid'];
$msgto=$_POST['msgto'];
$msgfrom=$_POST['msgfrom'];




$sql="SELECT * FROM messages WHERE msgto='".$msgto."' AND msgfrom='".$msgfrom."' AND todelete='".$_SESSION['uid']."' OR msgfrom='".$msgto."' AND msgto='".$msgfrom."' AND todelete='".$_SESSION['uid']."' ORDER BY msgid DESC";
$res=mysql_query($sql) or die(mysql_error());


$color='1';

if(mysql_num_rows($res)>'0')
{
while($row=mysql_fetch_assoc($res))
{
$msgfrom=$row['msgfrom'];
$msgto=$row['msgto'];
$msgcontent=$row['msgcontent'];
$ii=$row['msgid'];

$sql2="SELECT * FROM users WHERE id='".$msgfrom."' LIMIT 1";
$res2=mysql_query($sql2) or die(mysql_error());
$rows2=mysql_fetch_assoc($res2);


$posttime=strtotime($row['msgtime']);
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


$sql4="SELECT * FROM  active_members WHERE username ='".$rows2['username']."'";
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


echo "<tr bgcolor='#ededed'><td width='5%'>&nbsp;</td><td align='center' bgcolor='#ccc'><a class='msgk' id='".$ii."' href='mdelete.php?msgid=".$msgid."&msgto=".$msgfrom."&msgfrom=".$msgto."&id=".$ii."' title='delete'>X</a></td><td align='left'><font size=2 color='black'><b>".ucfirst(strtolower($rows2['username']))." </b></font><br><font size='2' color='grey'><i>".nl2br($msgcontent)."</i></font><br><font size='1' color='orange'><b><i>".date("g:ia", strtotime($row['msgtime']))." (".$count." ".$suf.")</i></b></font></td> <td align='right'>".$sess."&nbsp;&nbsp;</a></td></tr>";
$color='2';
}
else
{
echo "<tr bgcolor='#fff'><td width='1%'>&nbsp;</td><td align='center' bgcolor='#ededed'><a class='msgk' id='".$ii."' href='mdelete.php?msgid=".$msgid."&msgto=".$msgfrom."&msgfrom=".$msgto."&id=".$ii."' title='delete'>X</a></td><td align='left'><font size=2 color='black'><b>".ucfirst(strtolower($rows2['username']))." </b></font><br><font size='2' color='grey'><i>".nl2br($msgcontent)."</i></font><br><font size='1' color='orange'><b><i>".date("g:ia", strtotime($row['msgtime']))." (".$count." ".$suf.")</i></b></font></td> <td align='right'>".$sess."&nbsp;&nbsp;</a></td></tr>";

$color='1';


}


}

}
else
{
echo "<tr><td><p><font color='red'>No messages to display</font></p></td></tr>";
}
?>
</table>

<script type="text/javascript" src="jquery.min.js"></script>
	<script type="text/javascript">

		$('.msgk').click(function() {
		$('#ee').show();
		var id=$(this).attr('id');
		$.post('mdelete2.php',{id:id}, function(data) {
		$('#ee').hide();
        });
		
		return false;
	})
	
</script>