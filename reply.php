<?php
session_start();
?>
<?php
include('check.php');
include('config.php');


$frooo=$_GET['msgfrom'];
$tooo=$_GET['msgto'];
if(isset($_GET['send']) && $_GET['send']=='success')
{
$msgggg="Reply sent successfuly";
}

if(isset($_POST['sub']))
{
if($_POST['m']!='')
{
$sql01="INSERT INTO messages (msgfrom,msgto,msgcontent,msgtime,todelete) VALUES ('".$tooo."','".$frooo."','".$_POST['m']."',now(),'".$frooo."')";
$sql02="INSERT INTO messages (msgfrom,msgto,msgcontent,msgtime,todelete) VALUES ('".$tooo."','".$frooo."','".$_POST['m']."',now(),'".$tooo."')";
mysql_query($sql01) or die(mysql_error());
mysql_query($sql02) or die(mysql_error());



header('location:reply.php?msgid='.$_GET['msgid'].'&msgto='.$_GET['msgto'].'&msgfrom='.$_GET['msgfrom'].'&send=success');
exit();
}
else

$msg="Please write a message to send";
}
?>
<?php
$sqlgg="SELECT * FROM users WHERE id='".$_GET['msgfrom']."' LIMIT 1";
$resgg=mysql_query($sqlgg) or die(mysql_error());
$gg=mysql_fetch_assoc($resgg);
$va=$gg['username'];


$msgid=$_GET['msgid'];
$msgto=$_GET['msgto'];
$msgfrom=$_GET['msgfrom'];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Reply</title>
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
	<p><font size="3" color='white'><b>Message Reply</b></font></p>
	</td></tr>
	
		<tr><td align="left">
	<hr>
	</td></tr>
	
		<tr><td align="left">
		
		
		

	
		<?php

$ss="UPDATE messages set status='read' WHERE msgto='".$_SESSION['uid']."' AND msgfrom='".$msgfrom."' AND todelete='".$_SESSION['uid']."'";
$rr=mysql_query($ss) or die(mysql_error());



$sql="SELECT * FROM messages WHERE msgto='".$msgto."' AND msgfrom='".$msgfrom."' OR msgfrom='".$msgto."' AND msgto='".$msgfrom."' AND todelete='".$msgto."' ORDER BY msgid DESC LIMIT 5";
$res=mysql_query($sql) or die(mysql_error());
if(mysql_num_rows($res)>0)
{


?>


<input type='hidden' value='<?php echo $msgid;?>' id="msgid">
<input type='hidden' value='<?php echo $msgto;?>' id="msgto">
<input type='hidden' value='<?php echo $msgfrom;?>' id="msgfrom">
<?php echo $re;?>
<font color='red' size=2><?php echo $msg;?>

<div id="errory"></div>
<div id="namey"></div>
<div id="datay"></div>
<div id="statey"></div>
<div id="sucy"></div>
<div id="connect"></div>

</font>
<form action='' method='post'>
<p><font color='red' size=2><?php echo $msgggg;?></font></p>
<p><font size=2>TO:</font>&nbsp;&nbsp;<b><?php echo ucfirst($va);?><input type="hidden" value="<?php echo $frooo;?>" id="tot"></b></p>
<p><textarea rows=3 cols=30 name='m' id="mt"></textarea></p>
<p><font color='red'><?php echo $m;?></font></p>
<p><input class='reply' type='submit' name='sub' id="submity" value='reply' ></p>
</form>
<div id='msgs'>
<table border='0' align="left" id='register' align='center' cellspacing=0 width=100%>
<?php
include('config.php');

$msgid=$_GET['msgid'];
$msgto=$_GET['msgto'];
$msgfrom=$_GET['msgfrom'];


$perpage=5;
$rs=mysql_query("SELECT count(*) FROM messages WHERE msgto='".$msgto."' AND msgfrom='".$msgfrom."' AND todelete='".$msgto."' OR msgfrom='".$msgto."' AND msgto='".$msgfrom."' AND todelete='".$msgto."' ORDER BY msgid DESC") or die(mysql_error());


$pages=ceil(mysql_result($rs,0)/$perpage);

if(isset($_GET['pn']))
{
$page=(int)$_GET['pn'];
}
else
{
$page=1;
}
$start=($page-1)*$perpage;



$sql="SELECT * FROM messages WHERE msgto='".$msgto."' AND msgfrom='".$msgfrom."' AND todelete='".$msgto."' OR msgfrom='".$msgto."' AND msgto='".$msgfrom."' AND todelete='".$msgto."' ORDER BY msgid DESC LIMIT $start,$perpage";
$res=mysql_query($sql) or die(mysql_error());


$color='1';

if(mysql_num_rows($res)>'0')
{

if($page !=1)
{
$back=$_GET['pn']-1;
echo "<td bgcolor='black' align='center' colspan='4'>&nbsp;<a href='reply.php?msgid=".$_GET['msgid']."&msgto=".$_GET['msgto']."&msgfrom=".$_GET['msgfrom']."&pn=".$back."'> <font size='3' color='white'>View Newer Messages </font></a>&nbsp;</td></tr>";

}


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


echo "<tr bgcolor='#ededed'><td width='5%'>&nbsp;</td><td align='center' bgcolor='#ededed'><a class='msgk' id='".$ii."' href='mdelete.php?msgid=".$_GET['msgid']."&msgto=".$_GET['msgto']."&msgfrom=".$_GET['msgfrom']."&id=".$ii."' title='delete'>X</a></td><td align='left'><font size=2 color='black'><b>".ucfirst(strtolower($rows2['username']))." </b></font><br><font size='2' color='grey'><i>".nl2br($msgcontent)."</i></font><br><font size='1' color='orange'><b><i>".date("g:ia", strtotime($row['msgtime']))." (".$count." ".$suf.")</i></b></font></td> <td align='right'>".$sess."&nbsp;&nbsp;</a></td></tr>";
$color='2';
}
else
{
echo "<tr bgcolor='#fff'><td width='1%'>&nbsp;</td><td align='center' bgcolor='#ededed'><a class='msgk' id='".$ii."' href='mdelete.php?msgid=".$_GET['msgid']."&msgto=".$_GET['msgto']."&msgfrom=".$_GET['msgfrom']."&id=".$ii."' title='delete'>X</a></td><td align='left'><font size=2 color='black'><b>".ucfirst(strtolower($rows2['username']))." </b></font><br><font size='2' color='grey'><i>".nl2br($msgcontent)."</i></font><br><font size='1' color='orange'><b><i>".date("g:ia", strtotime($row['msgtime']))." (".$count." ".$suf.")</i></b></font></td> <td align='right'>".$sess."&nbsp;&nbsp;</a></td></tr>";

$color='1';


}



}

if($page !=$pages)
{
$_GET['pn']=1;
$next=$_GET['pn']+1;
echo "<td bgcolor='black' align='center' colspan='4'>&nbsp;<a href='reply.php?msgid=".$_GET['msgid']."&msgto=".$_GET['msgto']."&msgfrom=".$_GET['msgfrom']."&pn=".$next."'> <font size='3' color='white'>View Older Messages </font></a>&nbsp;</td></tr>";
}

}
else
{
echo "<tr><td><p><font color='red'>No messages to display</font></p></td></tr>";

}
?>
</table>
</div>


<div id='load'></div>
<div id="mgg" style="display:none">

</div>
<?php
echo "<table><tr><td><br/><a id='registerlink' href='http://m.vinnettech.com/newmessages.php'>&nbsp;&nbsp;return to inbox&nbsp;&nbsp;</a></td></tr>";


echo "</table>";
}
else
{
echo "<table align='center'><tr><td><font color=red size=2>No messages</font></td></tr></table>";

}

//x

$new_userid=mysql_insert_id();
$sqlz="SELECT * FROM messages WHERE msgfrom='".$_SESSION['uid']."' ORDER BY msgid DESC LIMIT 1";
$resz=mysql_query($sqlz) or die(mysql_error());
if(mysql_num_rows($resz)>0)
{
echo "<table border=5>";
while($rowz=mysql_fetch_assoc($resz))
{
$msgfrom=$row['msgfrom'];
$msgto=$row['msgto'];
$msgcontentz=$rowz['msgcontent'];
$re.="";
$re.= "<tr><td><font color='black' size=2>&nbsp;&nbsp;<b>REPLY:</b></font>&nbsp;&nbsp;<font color='green' size=2><b>".$msgcontentz."</b></font></td></tr>";
$re.= "<tr><td><hr></td></tr>";
}
echo "</table>";
}
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
	
	$('#submity').click(function() {
	

    var name=$('#tot').val()
	var mess=$('#mt').val()
	
if(name=='')
{
$('#namey').html('<font color="red">Please provide a name</font>').show().fadeOut(5000);
}	
else if(mess=='')
{
$('#errory').html('<font color="red">Please provide a message</font>').show().fadeOut(5000);
}
else
{
var frr=$('#msgfrom').val();
$('#statey').html('<font color="green">Sending...Please wait....</font>').show();
$.post('reply2.php',{n:name,m:mess,msgfrom:frr}, function(data) {
$('#datay').html(data);
$('#sucy').html('<font color="red">Message Sent Successfully</font>').show().fadeOut(5000);
$('#statey').html('<font color="green">Sending...Please wait....</font>').hide();
});

clearInput();
}





return false;

});


function clearInput(){
$('#mt').each(function(){
$(this).val('');
});


}

function check()
{
var online=window.navigator.onLine;
if(!online)
{
alert("Please check your internet connection and try again");
}

}	
	
	
	
	
	
	$(document).ready(function() {
	 $('#msgs').hide();

$('#load').html('Fetching Messages, Please wait.......').show();

var idd=$('#msgid').val();
var tto=$('#msgto').val();
var ffr=$('#msgfrom').val();


     var interval=setInterval(function(){

	 $.post('getreplyjs.php',{msgid:idd,msgto:tto,msgfrom:ffr}, function(data) {

 $('#mgg').html(data).show();
$('#load').html('pFetching Messages, Please wait.......').hide();
});




}, 1000);





});





	$().click(function() {
	 $('#msgs').hide();

$('#load').html('Fetching Messages, Please wait.......').show();

var idd=$('#msgid').val();
var tto=$('#msgto').val();
var ffr=$('#msgfrom').val();


     var interval=setInterval(function(){

	 $.post('getreplyjs.php',{msgid:idd,msgto:tto,msgfrom:ffr}, function(data) {

 $('#mgg').html(data).show();
$('#load').html('pFetching Messages, Please wait.......').hide();
});




}, 1000);





});


	
	

	
	
	
	</script>

 
</body>
</html>