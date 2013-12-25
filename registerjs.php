<?php
include('config.php');
$u=mysql_real_escape_string(strip_tags(trim($_POST['u'])));
$e=mysql_real_escape_string(strip_tags(trim($_POST['e'])));
$ce=mysql_real_escape_string(strip_tags(trim($_POST['ce'])));
$fn=mysql_real_escape_string(strip_tags(trim($_POST['fn'])));
$ln=mysql_real_escape_string(strip_tags(trim($_POST['ln'])));
$uu=mysql_real_escape_string(strip_tags(trim($_POST['uu'])));
$p=mysql_real_escape_string(strip_tags(trim($_POST['p'])));
$cp=mysql_real_escape_string(strip_tags(trim($_POST['cp'])));
$m=mysql_real_escape_string(strip_tags(trim($_POST['m'])));
$cou=mysql_real_escape_string(strip_tags(trim($_POST['cou'])));
$statee=mysql_real_escape_string(strip_tags(trim($_POST['state'])));




$errors=array();
if($fn=='')
{
$errors[]="Please fill in the firstname";
}
else
{
if(strlen($fn)<3)
{
$errors[]="Firstname must be more than 3 characters";
}

if(strlen($fn)>15)
{
$errors[]="Firstname must be less than 15 characters";
}

if(is_numeric($fn[0]))
{
$errors[]="Firstname can not begin with a numeric";
}
}

if($ln=='')
{
$errors[]="Please fill in the last name";
}
else
{
if(is_numeric($ln[0]))
{
$errors[]="Lastname can not begin with a numeric";
}

if(strlen($ln)<3)
{
$errors[]="Lastname must be more than 3 characters";
}

if(strlen($ln)>15)
{
$errors[]="Lastname must be less than 15 characters";
}
}

if($uu=='')
{
$errors[]="Please fill in the username";
}
else
{
if(is_numeric($uu[0]))
{
$errors[]="Username can not begin with a numeric";
}

if(strlen($uu)<3)
{
$errors[]="Username must be more than 3 characters";
}

if(strlen($uu)>15)
{
$errors[]="Username must be less than 15 characters";
}
}


if($cou=='choose a country')
{
$errors[]="Please select a country";
}


if($statee=='')
{
$errors[]="Please fill in a state";
}
else
{

if(strlen($statee)<3)
{
$errors[]="State must be more than 3 characters";
}

if(strlen($statee)>15)
{
$errors[]="State must be less than 15 characters";
}

}

if($e=='')
{
$errors[]="Please fill in the email";
}
elseif($e=='')
{
$errors[]="Please fill in your email";
}

elseif($e!=filter_var($e,FILTER_VALIDATE_EMAIL))
{
$errors[]="unknown email format";
}


if($e!=$ce)
{
$errors[]="Emails dont match";
}



if($m=='')
{
$errors[]="Please do the Math";
}
elseif($m!=9)
{
$errors[]="Are you sure 5+4=".$m." ??? I dont think so";
}

if($p=='')
{
$errors[]="Please fill in the password";
}
else
if($p!=$cp)
{
$errors[]="passwords dont match";
}
else
{
if(strlen($p)<3)
{
$errors[]="Password must be more than 3 characters";
}

if(strlen($p)>15)
{
$errors[]="Password must be less than 15 characters";
}
}

if(empty($errors))
{


$sql="SELECT email FROM users where email='".$e."' LIMIT 1";
$res=mysql_query($sql) or die(mysql_error());
if(mysql_num_rows($res)==1)
{

$u=mysql_real_escape_string(strip_tags($_POST['u']));

echo "<font color='red' size=2>Email already exists</font>";
}
else
{

$sql="SELECT username FROM users where username='".$uu."' LIMIT 1";
$res=mysql_query($sql) or die(mysql_error());
if(mysql_num_rows($res)==0)
{


$e=mysql_real_escape_string(strip_tags($_POST['e']));

$activationcode=md5($p.$e);
$pp=$p;
$sql="INSERT INTO users (fname,lname,email,username,password,activation_code,activated,date_activated,country,state) VALUES('".$fn."','".$ln."','".$e."','".$uu."' ,'".$pp."' ,'".$activationcode."','1',now(),'".$cou."','".$statee."')";
mysql_query($sql) or die(mysql_error());

$new_userid=mysql_insert_id();

if(!file_exists("../users/".$new_userid))
{
mkdir("../users/".$new_userid,0755);
}


$to=$e;
$from="vinmeddie@vinnettech.com";
$subject="Activate your Account";
$message="
<h3>Welcome to the site ".ucfirst(strtolower($fn))."!</h3>
<p>Click here to activate your account</p>
<p><a href='http://www.vinmeddie?id=".$new_userid."&activate=".$activationcode."'>http://www.vinmeddie?id=".$new_userid."activate=".$activationcode."'</a></p>
<b>Email: ".$e."</b>
<b>Password: ".$p."</b>
<p>Thank you for registering with us,  see on the site.</p>
";
$headers='MIME-Version: 1.0'."\r\n";
$headers.='Content-type: text/html; charset=iso-8859-1'."\r\n";
$headers.='From:$from\r\nReply-To:$from';
mail($to,$subject,$message,$headers);

echo "<font color='red' size=2>Your acccount has been created successfully<br> You can <a href='login.php'>Login here</a></font>";
}
else
{
echo "<font color='red' size=2>Username already exists</font>";

}

}
}

else
{


if(isset($errors))
{
foreach($errors as $error)
{
echo "<tr><td colspan=3><font color='red' size=2>".$error.'<br></td></tr>';
}
}


}











?>