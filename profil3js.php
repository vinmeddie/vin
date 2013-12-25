
<?php

include('config.php');


$sqlpp="SELECT * FROM users WHERE id='".$_POST['n']."' LIMIT 1";
$respp=mysql_query($sqlpp) or die(mysql_error());
$pass=mysql_fetch_assoc($respp);

$sql4="SELECT * FROM  active_members WHERE username ='".$pass['username']."' LIMIT 1";
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


//get visitors
$nn=mysql_query("SELECT * FROM pofilevisitors WHERE visited='".$_POST['n']."'");
$p=mysql_num_rows($nn);
if($p=='1')
{
$mm=$p." Visitor";
}
else
{
$mm=$p." Visitors";
}
//end get visitors

 
 $img="../users/default/profile.jpg";

if($pass['profilepicture']=='')
{
$pass['profilepicture']=$img;
}
else
{
$pass['profilepicture']="../users/".$pass['id']."/images/".$pass['profilepicture'];
}

?>


    <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr bgcolor="#ccc">
    <td width=20% align='center'><?php echo"<img src='".$pass['profilepicture']."' width=70 height=70>";?></td>
    <td valign='top'>
    <table width="100%" border="0">
    <tr><td><a href='profile2.php?user=<?php echo $_POST['n'];?>'><font size=3 color='black'><b><?php echo ucfirst(strtolower($pass['username']))." ".$sess;?></b></font></a></td></tr>
	<tr><td><font size=2 color='white'><b><?php echo ucfirst(nl2br($pass['aboutme']));?></b></font></td></tr>
	
	<tr><td><font size=2 color='white'><i>&nbsp;&nbsp; Lives in <b><?php echo ucfirst($pass['country']);?></b></i></font>
	</td></tr>
	<tr><td><font size=2 color='white'> <i><b><?php echo $mm;?></b></i></font></td></tr>
     
	 
	 
	 
	 </table>

    </td>
  </tr>
  <tr><td colspan=2><hr style='color:#ccc;'></td></tr>
  
   <tr><td colspan=2>
   
   &nbsp;&nbsp;<input type="submit" value="Send Message" id="message" class="link">
   
   </td></tr>
   
   
      <tr><td colspan=2>
	  <div id="r1"  align='center'></div>
	  <div id="state"  align='center'></div>
	  <div id="suc"  align='center'></div>
	  
   <div id="send" style="display:none;" align='center'>
  
    &nbsp;&nbsp;<input type="hidden" value="<?php echo $_POST['name'];?>" id="val">

	<p>
 <textarea rows=5 cols=30 name='m' id="m" placeholder="type here a message"></textarea>
 </p>
 <p>
                 <input type="hidden" value="<?php echo $_POST['n']?>" id="us">
   &nbsp;&nbsp;<input type="submit" value="Send Message" id="go" class='button'>
   </p>
   </div>
   </td></tr>
   
      <tr><td colspan=2>
   
   &nbsp;&nbsp;<a href="profile3.php?user=<?php echo $_POST['n'];?>"><font color="grey" size="2">View full profile</font></a>
   
   </td></tr>
   
         <tr><td colspan=2>
   
   &nbsp;&nbsp;<a href="profilephoto.php?user=<?php echo $pass['username']?>&id=<?php echo $_POST['n'];?>"><font color="grey" size="2">View user photos</font></a>
   
   </td></tr>
   
</table>



<script type="text/javascript" src="jquery.min.js"></script>
	<script type="text/javascript">
	
	$('#message').click(function() {
$('#message').hide();	
$('#send').fadeIn();
   
   })
   
   $('#go').click(function() {
	var mess=$('#m').val()
	var name=$('#us').val()
	
if(mess=='')
{
$('#r1').html('<font color="red">Please provide a message</font>').show().fadeOut(5000);
}
else
{

$('#state').html('<font color="green">Sending...Please wait....</font>').show();
$.post('reply2.php',{n:name,m:mess}, function(data) {
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
