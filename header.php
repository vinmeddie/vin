<?php
include('config.php');

$sql="SELECT * FROM messages WHERE msgto='".$_SESSION['uid']."' AND status='unread' AND todelete='".$_SESSION['uid']."'";
$res=mysql_query($sql) or die(mysql_error());
$mk=mysql_num_rows($res);

$mmm=" <span id='msgi'><font color='white'> (".$mk.")</font></span>";


$sqlxx=mysql_query("SELECT * FROM  active_members WHERE username !='".$_SESSION['username']."'");
$mkxx=mysql_num_rows($sqlxx);

$onl=" <span><font color='white'> (".$mkxx.")</font></span>";

?>

  <div class="header" style="height:30px;">
  
  <div style="position:absolute;line-height:30px;left:5px;"><a style="text-decoration:none;" href="index.php"><font size="4" color="white"><b>VinNetTech</b></font></a> </div>
   
	
	</div>
	
	
	
	
	
		<?php
	$sqlkkkk=mysql_query("SELECT * FROM friend WHERE userone='".$_SESSION['username']."' OR usertwo='".$_SESSION['username']."' ") or die(mysql_error());
  $nno=mysql_num_rows($sqlkkkk);
  $mmmk=" <span><font color='white'> (".$nno.")</font></span>";

	?>
	
			<?php
	$nott=mysql_query("SELECT * FROM m_not WHERE owner!='".$_SESSION['uid']."' ") or die(mysql_error());
  $notv=mysql_num_rows($nott);
  $not=" <span><font color='white'> (".$notv.")</font></span>";

	?>
	
	  <div class="header" style="height:20px;">
  
  <div style="position:absolute;line-height:20px;left:5px;">
  	<span class="home"><a href="index.php"><font size="2">Home</font> &nbsp;</a></span>
  	<span class="home"><a href="profile3.php?view=info&user=<?php echo $_SESSION['uid'];?>"><font size="2">Profile</font> &nbsp;</a></span>
	<span class="home"><a href="friends.php"><font size="2">Friends <?php echo $mmmk?> </font>&nbsp;</a></span>
	<span class="home"><a href="nots.php"><font size="2">Notifications <?php echo $not?> </font>&nbsp;</a></span>
	<span class="home"><a href='newmessages.php'><font size="2" color='white'>Messages <?php echo $mmm ?> <span id="monki" style="display:none;color:white;"></span></font></a> </p>
 &nbsp;</a></span>

  </div>
   
	
	</div>

	
		  <div class="header" style="height:20px;">
	
			<?php
	$sqlvb=mysql_query("SELECT * FROM friend_req WHERE too='".$_SESSION['username']."'") or die(mysql_error());
  $ncv=mysql_num_rows($sqlvb);
  $vb=" <span><font color='white'> (".$ncv.")</font></span>";

	?>
  
  <div style="position:absolute;line-height:20px;left:5px;">
  	<span class="home"><a href="notifications.php"><font size="2">Requests <?php echo $vb;?> </font> &nbsp;</a></span>
	<span class="home"><a href="online.php"><font size="2">Online <?php echo $onl;?> </font>&nbsp;</a></span>
    <span class="home"><a href="settings.php"><font size="2">Settings</font> &nbsp;</a></span>
	<span class="home"><a href="chat.php"><font size="2">Chatroom</font> &nbsp;</a></span>

  </div>
   
	
	</div>
	
	
	
	

	<script type="text/javascript" src="jquery.min.js"></script>
	<script type="text/javascript">
	
	$('#msgi').hide('fast');
	$('#monki').show('fast');
	
	$(document).ready(function() {

    var name=$('#useri').val()


     var interval=setInterval(function(){
	
	 $.post('msgjs.php', function(data) {

 $('#monki').html('<font color="white">('+data+' )</font>');

});




}, 1000);





});



	
	</script>