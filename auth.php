<?php
session_start();
?>
<?php
include('config.php');


	$e = mysql_real_escape_string(trim($_POST['username']));
	$p = mysql_real_escape_string(trim($_POST['pw']));
	
	$sql="SELECT * FROM users WHERE email='".$e."' AND password='".$p."' AND activated='1' OR username='".$e."' AND password='".$p."' AND activated='1'";
    $res=mysql_query($sql) or die(mysql_error());
	
if(mysql_num_rows($res)==1)
{
$row=mysql_fetch_assoc($res);
$_SESSION['username']=$row['username'];
$_SESSION['uid']=$row['id'];
		echo "good";
	
	}
	
	else { 
echo "bad";
	}

?>