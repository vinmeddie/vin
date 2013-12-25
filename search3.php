<?php
session_start();
?>
<?php
include('functions.php');
include('config.php');


?>
<?php
if(empty($_SESSION['uid']))
{
header('location:login.php');
exit();
}
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
	<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='search.php'><font size="3" color='white'><b>Search Results</b></font></a></p>
	</td></tr>
	
		<tr><td align="center">
<form action='search3.php?hide=true' name='sa' method='post'> <br/><input class="input" type='text' id='on' autocomplete="off" placeholder="search for a user" name='search'/><input class="search" type='submit' id='two' name='s' value='Search'/>  </form>
<div id="sea" style="display:none;border:1px solid green;border-radius:5px;text-align:left;height:auto;position:absolute;right:50%;width:240px;background:#ededed;cursor:pointer;

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
	

		<table width=90%><tr><td align='center'>

<?php
if(isset($_POST['s']))
{

$er=array();
if($_POST['search']=='')
{
$er[]="Please input a search string";
}

if(empty($er))
{
$sqlt="SELECT * FROM users WHERE username LIKE '%".$_POST['search']."%'";
$rest=mysql_query($sqlt) or die(mysql_error());
$top=mysql_num_rows($rest);
if(mysql_num_rows($rest)==0)
{
$t="<font color='orange'>no results found</font>";
$td="<font color='black'>Try searching using a <b>Username</b></font>";
}
elseif(mysql_num_rows($rest)>0)
$t="<font color='orange'>".$top." result found</font>";
else
$t="<font color='orange'>".$top." results found</font>";


echo "<table border='0' width=100% style='border:1px solid black'><tr><td>";

echo "<table border=0 width=100% style='border:1px solid black'>";
echo "<tr><td align='center'><font size=2>Search results for <font color='orange'><b>".$_POST['search']." </b></font></font></td></tr>";
echo "<tr><td align='center'><font size=2><b>".$t." </b></font></td></tr>";
echo "<tr><td align='center'><font size=2><b>".$td." </b></font></td></tr>";
echo "</td></tr></table>";
echo "</td></tr><tr><td>";
echo "<table border='0' width=100%>";
while($row=mysql_fetch_assoc($rest))
{


 $img="../users/default/profile.jpg";

if($row['profilepicture']=='')
{
$row['profilepicture']=$img;
}
else
{
$row['profilepicture']="../users/".$row['id']."/images/".$row['profilepicture'];
}



echo "<tr style='border:1px solid grey;' bgcolor='#ccc'><td align='center'><img src='".$row['profilepicture']."' width=70 height=70></td> 

<td valign='center' width='95%' cellspacing='0' cellpadding='0'> 
<table width=100% border=0> 
<tr><td width=20%><font size=2 color='black'>&nbsp;&nbsp;&nbsp;&nbsp;<b>Username:</b></font></td><td><font size=2><a class='preset_text' id=".$row['id']." href='profile3.php?user=".ucfirst($row['id'])."'><font color='orange'>".ucfirst(strtolower($row['username']))."</font></td></tr>  
<tr><td width=20%><font size=2 color='black'>&nbsp;&nbsp;&nbsp;&nbsp;<b>Joined on:</b></font></td><td><font color='green'>".date("M j,Y g:ia",strtotime($row['date_activated']))." </font></font> </table> </td></tr>  </td></tr>";

}


echo "</table>";
echo "</td></tr></table>";


}
else
{

echo "<table border=0 width=100% style='border:1px solid black'>";
foreach($er as $r)
{
echo "<tr><td align='center'><font size=2 color='red'>".$r."</font></td></tr>";
}

echo "</table>";

}



}
?>

</td></tr></table>




	
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