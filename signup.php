<?php 
session_start();
?>
<?php

if(isset($_SESSION['uid']))
{
header('location:index.php');
exit();
}

?>
<?php
include('config.php');
if(isset($_POST['sub']))
{
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

$errors[]="Email already exists";

$congs2="
<table border=0 class='msg'>
<tr><td align='center'><font color='red' size=2>
<b>Sorry!</b><br>
Registration failed<br> 
<b>Email already exists</b> please try again later
</font>
</td></tr>
</table>

";
}
else
{

$sql="SELECT username FROM users where username='".$uu."' LIMIT 1";
$res=mysql_query($sql) or die(mysql_error());
if(mysql_num_rows($res)==0)
{

$congs= "
<table border=0 class='msg'>
<tr><td align='center'>
<font color='red'><br><b>Congratulations!</b><br><br>
Your account has been succesfully created. <br>You can now <br><br><a href='login.php'>Login Here</a><br></font>

</td></tr>
</table>
";

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
}
else
{
$errors[]="Username already exists";
$congs2="
<table border=0 class='msg'>
<tr><td align='center'><font color='red' size=2>
<b>Sorry!</b><br>
Registration failed<br> 
please try again later
</font>
</td></tr>
</table>

";
}

}
}

else
{

$congs2="
<table border=0 class='msg'>
<tr><td align='center'><font color='red' size=2>
<b>Sorry!</b><br>
Registration failed<br> 
<b>".$re."</b> please try again later
</font>
</td></tr>
</table>

";

}








}

//echo "<form action='' method='POST' enctype='multipart/form-data'>";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Sign Up</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="description" content="Vinnettech helps you make friends." />
<meta name="HandheldFriendly" content="true" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta name="referrer" content="default" id="meta_referrer" />
<link rel='stylesheet' type='text/css' href='css.css'/>
</head>


<body>

<table width="100%" align="center" border="0">
<tr><td align="center" valign="middle">

<table width="100%" cellspacing="0" border="0">

<tr>
<td bgcolor="green">

<font size="6" color='white'><b>Sign Up for VinNetTech/<a href="login.php"><font size="6" color='orange'>Log In</font></a></b></font>

</td>
</tr>

<tr>
<td bgcolor="#ededed">
<table class="_4g33" border="0" width="100%">
<tr><td>

<table width="100%">
<tr><td colspan=3><font color='red' size=2><?php if(isset($errors)){foreach($errors as $error){echo $error.'<br>';}}?></font></td></tr>
<tr><td>
<div id="data"></div>
<div id="state"></div>
<div id="connect"></div>
<?php
echo $congs;
echo $congs2;

?>
</td></tr>
<form action='' method='POST' enctype='multipart/form-data'>
<tr><td><font size=2>First name: *</font></td><td><input type='text' name='fn' id="fn" value='<?php echo $fn;?>' ></td></tr>
<tr><td><font size=2>Last name: *</font></td><td><input type='text' name='ln' id="ln" value='<?php echo $ln;?>'></td></tr>
<tr><td><font size=2>Username: *</font></td><td><input type='text' name='uu' id="uu" value='<?php echo $uu;?>'></td></tr>

<tr><td><font size=2>Country: *</font></td><td>
<select name='cou' id="cou"><option value="choose a country" selected>choose a country</option><option value="Albania">Albania</option><option value="Algeria">Algeria</option><option value="American Samoa">American Samoa</option><option value="Andorra">Andorra</option><option value="Angola">Angola</option><option value="Anguilla">Anguilla</option><option value="Antarctica">Antarctica</option><option value="Antigua and Barbuda">Antigua and Barbuda</option><option value="Argentina">Argentina</option><option value="Armenia">Armenia</option><option value="Aruba">Aruba</option><option value="Australia">Australia</option><option value="Austria">Austria</option><option value="Azerbaijan">Azerbaijan</option><option value="Bahamas">Bahamas</option><option value="Bahrain">Bahrain</option><option value="Bangladesh">Bangladesh</option><option value="Barbados">Barbados</option><option value="Belarus">Belarus</option><option value="Belgium">Belgium</option><option value="Belize">Belize</option><option value="Benin">Benin</option><option value="Bermuda">Bermuda</option><option value="Bhutan">Bhutan</option><option value="Bolivia">Bolivia</option><option value="Bosnia and Herzegowina">Bosnia and Herzegowina</option><option value="Botswana">Botswana</option><option value="Bouvet Island">Bouvet Island</option><option value="Brazil">Brazil</option><option value="British Indian Ocean Territory">British Indian Ocean Territory</option><option value="Brunei Darussalam">Brunei Darussalam</option><option value="Bulgaria">Bulgaria</option><option value="Burkina Faso">Burkina Faso</option><option value="Burundi">Burundi</option><option value="Cambodia">Cambodia</option><option value="Cameroon">Cameroon</option><option value="Canada">Canada</option><option value="Cape Verde">Cape Verde</option><option value="Cayman Islands">Cayman Islands</option><option value="Central African Republic">Central African Republic</option><option value="Chad">Chad</option><option value="Chile">Chile</option><option value="China">China</option><option value="Christmas Island">Christmas Island</option><option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option><option value="Colombia">Colombia</option><option value="Comoros">Comoros</option><option value="Congo">Congo</option><option value="Cook Islands">Cook Islands</option><option value="Costa Rica">Costa Rica</option><option value="Cote D'Ivoire">Cote D'Ivoire</option><option value="Croatia">Croatia</option><option value="Cuba">Cuba</option><option value="Cyprus">Cyprus</option><option value="Czech Republic">Czech Republic</option><option value="Denmark">Denmark</option><option value="Djibouti">Djibouti</option><option value="Dominica">Dominica</option><option value="Dominican Republic">Dominican Republic</option><option value="East Timor">East Timor</option><option value="Ecuador">Ecuador</option><option value="Egypt">Egypt</option><option value="El Salvador">El Salvador</option><option value="Equatorial Guinea">Equatorial Guinea</option><option value="Eritrea">Eritrea</option><option value="Estonia">Estonia</option><option value="Ethiopia">Ethiopia</option><option value="Falkland Islands">Falkland Islands</option><option value="Faroe Islands">Faroe Islands</option><option value="Fiji">Fiji</option><option value="Finland">Finland</option><option value="France">France</option><option value="France, Metropolitan">France, Metropolitan</option><option value="French Guiana">French Guiana</option><option value="French Polynesia">French Polynesia</option><option value="French Southern Territories">French Southern Territories</option><option value="Gabon">Gabon</option><option value="Gambia">Gambia</option><option value="Georgia">Georgia</option><option value="Germany">Germany</option><option value="Ghana">Ghana</option><option value="Gibraltar">Gibraltar</option><option value="Greece">Greece</option><option value="Greenland">Greenland</option><option value="Grenada">Grenada</option><option value="Guadeloupe">Guadeloupe</option><option value="Guam">Guam</option><option value="Guatemala">Guatemala</option><option value="Guinea">Guinea</option><option value="Guinea-Bissau">Guinea-Bissau</option><option value="Guyana">Guyana</option><option value="Haiti">Haiti</option><option value="Heard and McDonald Islands">Heard and McDonald Islands</option><option value="Honduras">Honduras</option><option value="Hong Kong">Hong Kong</option><option value="Hungary">Hungary</option><option value="Iceland">Iceland</option><option value="India">India</option><option value="Indonesia">Indonesia</option><option value="Iran">Iran</option><option value="Ireland">Ireland</option><option value="Israel">Israel</option><option value="Italy">Italy</option><option value="Jamaica">Jamaica</option><option value="Japan">Japan</option><option value="Jordan">Jordan</option><option value="Kazakhstan">Kazakhstan</option><option value="Kenya">Kenya</option><option value="Kiribati">Kiribati</option><option value="Kuwait">Kuwait</option><option value="Kyrgyzstan">Kyrgyzstan</option><option value="Lao People&#39;s Republic">Lao People&#39;s Republic</option><option value="Latvia">Latvia</option><option value="Lebanon">Lebanon</option><option value="Lesotho">Lesotho</option><option value="Liberia">Liberia</option><option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option><option value="Liechtenstein">Liechtenstein</option><option value="Lithuania">Lithuania</option><option value="Luxembourg">Luxembourg</option><option value="Macau">Macau</option><option value="Macedonia">Macedonia</option><option value="Madagascar">Madagascar</option><option value="Malawi">Malawi</option><option value="Malaysia">Malaysia</option><option value="Maldives">Maldives</option><option value="Mali">Mali</option><option value="Malta">Malta</option><option value="Marshall Islands">Marshall Islands</option><option value="Martinique">Martinique</option><option value="Mauritania">Mauritania</option><option value="Mauritius">Mauritius</option><option value="Mayotte">Mayotte</option><option value="Mexico">Mexico</option><option value="Micronesia">Micronesia</option><option value="Moldova">Moldova</option><option value="Monaco">Monaco</option><option value="Mongolia">Mongolia</option><option value="Montserrat">Montserrat</option><option value="Morocco">Morocco</option><option value="Mozambique">Mozambique</option><option value="Myanmar">Myanmar</option><option value="Namibia">Namibia</option><option value="Nauru">Nauru</option><option value="Nepal">Nepal</option><option value="Netherlands">Netherlands</option><option value="Netherlands Antilles">Netherlands Antilles</option><option value="New Caledonia">New Caledonia</option><option value="New Zealand">New Zealand</option><option value="Nicaragua">Nicaragua</option><option value="Niger">Niger</option><option value="Nigeria">Nigeria</option><option value="Niue">Niue</option><option value="Norfolk Island">Norfolk Island</option><option value="Northern Mariana Islands">Northern Mariana Islands</option><option value="Norway">Norway</option><option value="Oman">Oman</option><option value="Pakistan">Pakistan</option><option value="Palau">Palau</option><option value="Panama">Panama</option><option value="Papua New Guinea">Papua New Guinea</option><option value="Paraguay">Paraguay</option><option value="Peru">Peru</option><option value="Philippines">Philippines</option><option value="Pitcairn">Pitcairn</option><option value="Poland">Poland</option><option value="Portugal">Portugal</option><option value="Puerto Rico">Puerto Rico</option><option value="Qatar">Qatar</option><option value="Reunion">Reunion</option><option value="Romania">Romania</option><option value="Russian Federation">Russian Federation</option><option value="Rwanda">Rwanda</option><option value="S. Georgia, S. Sandwich Isl.">S. Georgia, S. Sandwich Isl.</option><option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option><option value="Saint Lucia">Saint Lucia</option><option value="Saint Vincent and Grenadines&nbsp;">Saint Vincent and Grenadines&nbsp;</option><option value="Samoa">Samoa</option><option value="San Marino">San Marino</option><option value="Sao Tome and Principe">Sao Tome and Principe</option><option value="Saudi Arabia">Saudi Arabia</option><option value="Senegal">Senegal</option><option value="Seychelles">Seychelles</option><option value="Sierra Leone">Sierra Leone</option><option value="Singapore">Singapore</option><option value="Slovakia">Slovakia</option><option value="Slovenia">Slovenia</option><option value="Solomon Islands">Solomon Islands</option><option value="Somalia">Somalia</option><option value="South Africa">South Africa</option><option value="South Korea">South Korea</option><option value="Spain">Spain</option><option value="Sri Lanka">Sri Lanka</option><option value="St Helena">St Helena</option><option value="St Pierre and Miquelon">St Pierre and Miquelon</option><option value="Sudan">Sudan</option><option value="Suriname">Suriname</option><option value="Svalbard">Svalbard</option><option value="Swaziland">Swaziland</option><option value="Sweden">Sweden</option><option value="Switzerland">Switzerland</option><option value="Syrian Arab Republic">Syrian Arab Republic</option><option value="Taiwan">Taiwan</option><option value="Tajikistan">Tajikistan</option><option value="Tanzania">Tanzania</option><option value="Thailand">Thailand</option><option value="Togo">Togo</option><option value="Tokelau">Tokelau</option><option value="Tonga">Tonga</option><option value="Trinidad and Tobago">Trinidad and Tobago</option><option value="Tunisia">Tunisia</option><option value="Turkey">Turkey</option><option value="Turkmenistan">Turkmenistan</option><option value="Turks and Caicos Islands">Turks and Caicos Islands</option><option value="Tuvalu">Tuvalu</option><option value="Uganda">Uganda</option><option value="Ukraine">Ukraine</option><option value="United Arab Emirates">United Arab Emirates</option><option value="United Kingdom">United Kingdom</option><option value="United States">United States</option><option value="Uruguay">Uruguay</option><option value="US Minor Outlying Islands">US Minor Outlying Islands</option><option value="Uzbekistan">Uzbekistan</option><option value="Vanuatu">Vanuatu</option><option value="Vatican City State">Vatican City State</option><option value="Venezuela">Venezuela</option><option value="Viet Nam">Viet Nam</option><option value="Virgin Islands, British">Virgin Islands, British</option><option value="Virgin Islands, US">Virgin Islands, US</option><option value="Wallis and Futuna Islands">Wallis and Futuna Islands</option><option value="Western Sahara">Western Sahara</option><option value="Yemen">Yemen</option><option value="Yugoslavia">Yugoslavia</option><option value="Zaire">Zaire</option><option value="Zambia">Zambia</option><option value="Zimbabwe">Zimbabwe</option></select>
				
</td></tr>
<tr><td><font size=2>State: *</font></td><td><input type='text' name='state' id="statee" value='<?php echo $statee;?>'></td></tr>

<tr><td><font size=2>Email: *</font></td><td><input type='text' name='e' id="e" value='<?php echo $e;?>'></td></tr>
<tr><td> <font size=2>Confirm Email: *</font></td><td><input type='text' name='ce' id="ce" value='<?php echo $ce;?>'></td></tr>
<?php
//<tr><td>Username:</td><td><input type='text' name='u' value='<?php echo $u;'><td></tr>
?>
<tr><td><font size=2>Password: *</font></td><td><input type='password' name='p' id="p" value='<?php echo $p;?>'></td></tr>
<tr><td><font size=2>Confirm password: *</font></td><td><input type='password' name='cp' id="cp" value='<?php echo $cp;?>'></td></tr>
<tr><td><font size=2>Do some Math ( 5+4= *</font></td><td><input type='text' name='m' id="m" value='<?php echo $m;?>'></td></tr>
<tr><td>&nbsp;</td><td><input type='submit' name='sub' value='Register' id="submit"></td></tr>
<tr><td colspan=3>&nbsp;</td></tr>
<tr><td align='center' colspan=3><table id='new' border="0"><tr><td><b>Already have an Account??</b></td></tr><tr><td align="center"><a id='registerlink' href='login.php'>&nbsp;&nbsp;<font size=2>Sign in</font>&nbsp;&nbsp;</a></td></tr></table></td></tr>
</form>
</table>


</td>
</tr>



<tr>
<td bgcolor="green" align="center">
<font color='white' size="3"> Copyright &copy; 2013, Vin Ltd. All Rights Reserved</font>
</td>
</tr>

</table>

</td></tr></table>

</td></tr></table>



<script type="text/javascript" src="jquery.min.js"></script>
	<script type="text/javascript">
	
	$('#submit').click(function() {

var online=window.navigator.onLine;
if(!online)
{
$('#connect').html("<font color='green' size='2'><p align='center'>Please check your internet connection and try again</p></font>").show().fadeOut(9000);
}
else
{
    var u=$('#u').val()
	var e=$('#e').val()
	var ce=$('#ce').val()
	var fn=$('#fn').val()
	var ln=$('#ln').val()
	var uu=$('#uu').val()
	var p=$('#p').val()
	var cp=$('#cp').val()
	var m=$('#m').val()
	var cou=$('#cou').val()
	var state=$('#statee').val()
	

$('#state').html('<font color="green" size="2">Registering...Please wait....</font>').show();
$.post('registerjs.php',{u:u,e:e,ce:ce,fn:fn,ln:ln,uu:uu,p:p,cp:cp,m:m,cou:cou,state:state}, function(data) {
$('#data').html('<p>............................................................</p><br><b>'+data+'</b>').show().fadeOut(7000);

$('#state').html('<font color="green"><b>Registering...Please wait....</b></font>').hide();
});




}

return false;

});



	
	
	</script>


</body>
</html>