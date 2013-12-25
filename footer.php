
		<?php if(isset($_SESSION['username']))
{



?>
<?php
if(!isset($_GET['hide']) && !$_GET['hide']=='true')
{
?>
<p align='center'>

<form id="form" action='search3.php?hide=true' name='sa' method='post'>
<input class="input" type='text' id='on' autocomplete="off" placeholder="search for a user" name='search'/>
<input class="search" type='submit' id='two' name='s' value='Search'/>  
</form>


</p> 

<?php
}
?>


<p align='center'><font size="2" color='white'>Logged in as</font> <a href="http://m.vinnettech.com/profile3.php?view=info&user=<?php echo $_SESSION['uid']?>"><font color="red" size="2"><?php echo $_SESSION["username"]?></font></a> &nbsp;<a href='logout.php'><font color='pink' size='2'> ( Log Out )</font></a><br> 


<hr>
<?php

}
?>

<font color='white' size="2"> Copyright &copy; 2013, Vin Ltd. All Rights Reserved</font> | <a href='http://vinnettech.com/index.php?Desktop=1&goto=<?php echo $_SESSION['username']?>&cometo=<?php echo $_SESSION['uid']?>'><font size="2" color='white'>Go to full site</font></a>
</td>



  