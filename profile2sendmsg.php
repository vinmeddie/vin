<?php
session_start();
?>
<?php
include('check.php');
include('config.php');

if(isset($_POST['sub']))
{

$er=array();


if(($_POST['n']=='choose a name'))
{
$er[]="Please choose a name";
}
 
 if(($_POST['m']==''))
{
$er[]="Please write a message to send";
}
 
 if(empty($er))
 {
$sql2="SELECT * FROM users WHERE username='".$_GET['user']."' LIMIT 1";
$res2=mysql_query($sql2) or die(mysql_error());
$rows2=mysql_fetch_assoc($res2);

if(isset($_SESSION['admin']))
{
$_SESSION['uid']=$_SESSION['aduid'];
}

$sql01="INSERT INTO messages (msgfrom,msgto,msgcontent,msgtime) VALUES ('".$_SESSION['uid']."','".$rows2['id']."','".mysql_real_escape_string(strip_tags(trim($_POST['m'])))."',now())";
mysql_query($sql01) or die(mysql_error());

$i= "Message sent successfully to <font color='black'><b>".ucfirst($_GET['user'])."</b>";
//header('location:users.php'); 
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
<link rel='stylesheet' type='text/css' href='members.css'>
<link rel='stylesheet' type='text/css' href='header.css'>


<title>Send Message</title>
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



</div>

          <?php
	  $sql24="SELECT * FROM users WHERE username='".$_GET['user']."' LIMIT 1";
$res24=mysql_query($sql24) or die(mysql_error());
if(mysql_num_rows($res24)==1)
{
	  ?>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">

          <tbody>
            <tr>
              <td><font size="3"><b>Send Message</b></font> </td>
              
            </tr>
          </tbody>
        </table>
      </tr>
	  <tr>
        <td colspan="2">
		
		<table border=0>

<tr><td>
<table border=0 id='register' align='center'>
<form action='' method='POST' enctype='multipart/form-data'> 
<tr><td colspan=3 align='center'> <font color='red'><?php echo $i?></font> </td></tr>
<tr><td colspan=3 align='center'> <a href='profile3.php?user=<?php echo ucfirst($_GET['id'])?>'> <font color='orange' size=2><b>BACK TO <?php echo strtoupper($_GET['user'])?>'S PROFILE PAGE</b></font> </a></td></tr>
<tr><td>&nbsp;</td><td colspan=3><font color='red' size=2><?php if($er){foreach($er as $ers){echo $ers.'<br>';}}?></font>
<div id="empty"></div>
<div id="state"></div>
<div id="suc"></div>
<div id="data"></div>
<div id="connect"></div>
</td></tr>

<?php
$sql21="SELECT * FROM users WHERE username='".$_GET['user']."' LIMIT 1";
$res21=mysql_query($sql21) or die(mysql_error());
$rows21=mysql_fetch_assoc($res21);

?>
<tr><td><font size=2>TO: </td><td><b> <?php echo ucfirst($_GET['user']) ?> <input type="hidden" id="to" value="<?php echo $rows21['id']; ?>"></b></font></td><td>

</td></tr>
<tr><td><font size=2>MESSAGE:</font></td><td><textarea rows=5 cols=30 name='m' id="m"></textarea></td></tr>
<tr><td><font color='red'><?php echo $m;?></font></td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class='button' type='submit' name='sub' value='Send' id="submit"></td></tr>


</table>
</table>

		
		</td>
      </tr>


			  
			  <?php
			  }
			  else
			  {
echo"<p align='center'><font size=2>The username specified does not exist</font></p>";
echo"<p align='center'><a href='members.php'><font size=2>Click Here to go Back to Registered User's list</font></a></p>";
			  }
			  ?>
				
				</table>
		  </td>
	  </tr>
    </table>
 
  
        </div>
  <div class="footer" align="center">
    <p><?php include("footer.php");?></p>
    <!-- end .footer --></div>
  <!-- end .container --></div>
  
  
 <script type="text/javascript" src="jquery.min.js"></script>
	<script type="text/javascript">
	
	$('#submit').click(function() {

	
		
    var name=$('#to').val()
	var mess=$('#m').val()
	
	
if(mess=='')
{
$('#empty').html('<font color="red" size="2">Please provide a message</font>').show().fadeOut(5000);
}	
else if(name=='')
{
$('#empty').html('<font color="red">Please provide a name</font>').show().fadeOut(5000);
}
else
{
$('#state').html('<font color="green">Sending...Please wait....</font>').show();
$.post('profile2sendmsg2.php',{n:name,m:mess}, function(data) {
$('#data').html(data);
$('#suc').html('<font color="red">Message Sent Successfully</font>').show().fadeOut(5000);
$('#state').html('<font color="green">Sending...Please wait....</font>').hide();
});

clearInput();
}




return false;

});


function clearInput(){
$('#m').each(function(){
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
	
	</script>


</body>
</html>