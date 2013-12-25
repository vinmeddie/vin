

<table border=0 width=100% align='left'>



<?php
if(isset($_SESSION['username']))
{echo "


<tr><td bgcolor='white'>&nbsp;&nbsp;<font size=1><font size=1 color='white'><b><a href='profilepicture.php?user=".$_SESSION['uid']."&edit=avatar'>Edit Your Profile picture</b></font></a></td></tr>
<tr><td bgcolor='white'>&nbsp;&nbsp;<font size=1><font size=1 color='white'><b><a href='username.php?user=".$_SESSION['uid']."&edit=username'>Edit Your Username</b></font></a></td></tr>
<tr><td bgcolor='white'>&nbsp;&nbsp;<font size=1><font size=1 color='white'><b><a href='password.php?user=".$_SESSION['uid']."&edit=password'>Edit Your Password</b></font></a></td></tr>
<tr><td bgcolor='white'>&nbsp;&nbsp;<font size=1><font size=1 color='white'><b><a href='firstname.php?user=".$_SESSION['uid']."&edit=firstname'>Edit Your Firstname</b></font></a></td></tr>
<tr><td bgcolor='white'>&nbsp;&nbsp;<font size=1><font size=1 color='white'><b><a href='lastname.php?user=".$_SESSION['uid']."&edit=lastname'>Edit Your Lastname</b></font></a></td></tr>
<tr><td bgcolor='white'>&nbsp;&nbsp;<font size=1><font size=1 color='white'><b><a href='edit.php?user=".$_SESSION['uid']."'><font color='orange'>Edit Your Full profile</font></b></font></a></td></tr>

";
}?>


</table> 

