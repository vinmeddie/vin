<?php
$color='1';
while($row=mysql_fetch_assoc($res))
{
$msgfrom=$row['msgfrom'];
$msgto=$row['msgto'];
$msgcontent=$row['msgcontent'];

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


echo "<tr bgcolor='#ededed'><td align='left'><a href='http://m.vinnettech.com/reply.php?msgid=".$msgid."&msgto=".$msgto."&msgfrom=".$msgfrom."'> <font size=2 color='black'><b>".ucfirst(strtolower($rows2['username']))." </b></font><br><font size='2' color='grey'><i>".nl2br($msgcontent)."</i></font></a><br><font size='1' color='orange'><b><i>".date("g:ia", strtotime($row['msgtime']))." (".$count." ".$suf.")</i></b></font></td> <td align='right'>".$sess."&nbsp;&nbsp;</a></td></tr>";
$color='2';
}
else
{
echo "<tr bgcolor='#fff'><td align='left'><a href='http://m.vinnettech.com/reply.php?msgid=".$msgid."&msgto=".$msgto."&msgfrom=".$msgfrom."'> <font size=2 color='black'><b>".ucfirst(strtolower($rows2['username']))." </b></font><br><font size='2' color='grey'><i>".nl2br($msgcontent)."</i></font></a><br><font size='1' color='orange'><b><i>".date("g:ia", strtotime($row['msgtime']))." (".$count." ".$suf.")</i></b></font></td> <td align='right'>".$sess."&nbsp;&nbsp;</a></td></tr>";

$color='1';


}



}
?>