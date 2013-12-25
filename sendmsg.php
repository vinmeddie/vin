<?php
session_start();
?>
<?php
include('check.php');
include('config.php');

if(isset($_POST['n']) && isset($_POST['m']))
{

$er=array();


if(($_POST['n']=='choose a name'))
{
$er[]="Please choose a name";
}

if(($_POST['n']=='Sorry no friends to display'))
{
$er[]="Please choose a name";
}


if(($_POST['n']==''))
{
$er[]="Please choose a name";
}

if(($_POST['n']=='Sorry no friends to display'))
{
$er[]="Please choose a name";
}
 
 if(($_POST['m']==''))
{
$er[]="Please write a message to send";
}
 
 if(empty($er))
 {

$sql01="INSERT INTO messages (msgfrom,msgto,msgcontent,msgtime) VALUES ('".$_SESSION['uid']."','".$_POST['n']."','".mysql_real_escape_string(strip_tags(trim($_POST['m'])))."',now())";
mysql_query($sql01) or die(mysql_error());
$not="<tr><td>&nbsp;</td><td colspan=2><font color='red' size=2>Message Sent Successfully</font></td></tr>";
//header('location:sendmsg.php'); 
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


<title>VinNetTech</title>
</head>

<body>

<div class="container">

<?php include('header.php')?>

  <div class="content">
  
  

    
	<table width="100%" border="0" cellspacing="0" cellpadding="0">

	
	<tr><td align="left">
	<p><font size="3" color='white'><b>Compose A message</b></font>
	<br><hr></p>
	</td></tr>
	
		<tr><td align="left">


	

	
	
	
	
	
	
	<table border='0' id='register' align='left'>
<form action='sendmsg.php' method='post'>
<?php echo $not;?>
<?php if($er){foreach($er as $ers){echo "<tr><td>&nbsp;</td><td colspan=3><font color='red' size=2>".$ers.'<br></font></td></tr>';}}?>
<tr><td align="" colspan='2'>
<div id="errorr"></div>
<div id="namee"></div>
<div id="dataa"></div>
<div id="statee"></div>
<div id="succ"></div>
<div id="connectt"></div>
</td></tr>

<tr><td><font size=2>TO:</font></td><td>


<?php

$sql="SELECT * FROM friend WHERE userone='".$_SESSION['username']."' OR usertwo='".$_SESSION['username']."'";
$res=mysql_query($sql) or die(mysql_error());

if(mysql_num_rows($res)>0)
{
echo "<select name='n' class='n'>";
echo "<option value='choose a name'>choose a name</option>";
while($row=mysql_fetch_assoc($res))
{

$one=$row['userone'];
$two=$row['usertwo'];
$date=$row['time'];



if($one==$_SESSION['username'])
{
$user=$two;
}
else
{
$user=$one;
}

$sql3="SELECT * FROM users WHERE username='".$user."'";
$res3=mysql_query($sql3) or die(mysql_error());
$row3=mysql_fetch_assoc($res3);




$desc=$row['category_desc'];

echo "<option value=".$row3['id'].">".$user."</option>";
}
echo "</select>";
}
else
{
echo "<select name='n' class='n'>";
echo "<option value='Sorry no friends to display'>Sorry no friends to display</option>";
echo "</select>";
}


?>


</td></tr>
<tr><td><font size=2>MESSAGE:</font></td><td><textarea rows=5 cols=30 name='m' id="mk"></textarea></td></tr>
<tr><td><font color='red'><?php echo $m;?></font></td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='submit' value='Send' id="sa"></form></td></tr>
</table>

	
	
		</td></tr>
	
	
	
	
		
	</table>
 
  
        </div>
  <div class="footer" align="center">
    <p><?php include("footer.php");?></p>
    <!-- end .footer --></div>
  <!-- end .container --></div>
  
  
  	<script type="text/javascript" src="jquery.min.js"></script>
	<script type="text/javascript">
	
	$('#sa').click(function() {
	

    var name=$('.n').val();
	var mess=$('#mk').val();

	
if(name=='choose a name')
{
$('#errorr').html('<font color="red">Please provide a name</font>').show().fadeOut(5000);
}
else if(name=='Sorry no friends to display')
{
$('#errorr').html('<font color="red">Please provide a name</font>').show().fadeOut(5000);
}	
else if(mess=='')
{
$('#errorr').html('<font color="red">Please provide a message</font>').show().fadeOut(5000);
}
else
{
$('#statee').html('<font color="green">Sending...Please wait....</font>').show();
$.post('sendmsg2.php',{n:name,m:mess}, function(data) {
$('#dataa').html(data);
$('#succ').html('<font color="red">Message Sent Successfully</font>').show().fadeOut(5000);
$('#statee').html('<font color="green">Sending...Please wait....</font>').hide();
});

clearInput();
}





return false;

});


function clearInput(){
$('#mk').each(function(){
$(this).val('');
});

$('.n').each(function(){
$(this).val('choose a name');

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
	
	</script>

 

</body>
</html>