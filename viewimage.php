<?php 
session_start();
?>
<?php
include('check.php');
if(isset($_GET['view']) && isset($_GET['id']))
{
if($_GET['view']=='large')
{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>View Image</title>
<link rel='stylesheet' type='text/css' href='css.css'>

<?php
require('header.php');
include('config.php');
?>

<tr><td>

<table width="100%" border="0">
  <tr>
    <td width="25%" height="160" valign="top"><table width="100%" border="0"">
        <tr><td>&nbsp;</td><td valign='top'><?php include('sidebar.php')?></td></tr>
      </tr>
    </table></td>
	
	<td width="2%">&nbsp;</td>
	
    <td width="73%" valign="top"><br><table width="100%" border="0">
      

	  <tr>
        <td colspan="2">
		
		
<div class="bodyyy">  
<div class="title_bar">  

<table>
<tr><td align='center'><a href="photos.php">Photos</a></td>
<td align='center'><a href="create.php">Create Album</a></td>
<td align='center'><a href="upload.php">Upload Photos</a></td></tr>
</table>

</div>



<?php

$id=$_GET['id'];
$sql15="SELECT * FROM photos WHERE id='".$id."' AND user='".$_SESSION['uid']."'";
$res15=mysql_query($sql15) or die(mysql_error());
if(mysql_num_rows($res15)>=1)
{
?>

<div id="conn">

<?php
$sql1="SELECT * FROM photos WHERE id='".$id."' AND user='".$_SESSION['uid']."'";
$res1=mysql_query($sql1) or die(mysql_error());
if(mysql_num_rows($res1)>=1)
{
while($select=mysql_fetch_assoc($res1))
{
$alb=$select['album'];
$ab_name=$select['name'];
$p=$select['url'];
?>

<div id="view_box_big" align='center'>
<img src="users/<?php echo $_SESSION['uid']."/pictures/".$alb."/".$p;?>"><br>
<b><?php echo $ab_name?></b>

<div style="padding:3px;"></div>
<div style="background-color:#ccc;padding:5px;border-radius:5px;"> <a href='view.php?album=<?php echo$_GET['album']?>'>Back</a> </div>

</div>

<?php
}

}
else
{
echo "
<div id='error_box'>
No photos available.
</div>
";
}

?>

</div>


<?php
}
else
{
echo "<div id='error_box'>The photo specified does not exist</div>";
}



?>







</div>
		
		
		</td>
      </tr>

	  <tr>
	  <td>
	
				
                </td>
              </tr>
				
				</table>
		  </td>
	  </tr>
    </table>


	
 </td>
	  </tr>

<?php
require('footer.php');
?>								








<?php

}
elseif($_GET['view']=='edit' && isset($_GET['id']))
{

include('config.php');
require('header.php');
?>
<tr><td>

<table width="100%" border="0">
  <tr>
    <td width="25%" height="160" valign="top"><table width="100%">
        <tr><td>&nbsp;</td><td><?php include('sidebar.php')?></td></tr>
      </tr>
    </table></td>
	
	<td width="2%">&nbsp;</td>
	
    <td width="73%" valign="top"><br><table width="100%" border="0">
	  <tr>
        <td colspan="2">
		
		
<div class="bodyy">  
<div class="title_bar">  

<table>
<tr><td align='center'><a href="photos.php">Photos</a></td>
<td align='center'><a href="create.php">Create Album</a></td>
<td align='center'><a href="upload.php">Upload Photos</a></td></tr>

</table>

</div>



<?php

$sql2224="SELECT * FROM album WHERE id='".$_GET['id']."' AND user='".$_SESSION['uid']."' LIMIT 1";
$res2224=mysql_query($sql2224) or die(mysql_error());
if(mysql_num_rows($res2224)<1)
{

echo "<div id='album_erroru' align='center'><font size=2 color='red'><br><br>The specified Album does not exist</font></div>";
}
else
{
?>







<div id="cont">
<h3>Edit Album</h3>
<form method="post">

<?php

$sql1k="SELECT * FROM album WHERE id='".$_GET['id']."' AND user='".$_SESSION['uid']."' LIMIT 1";
$res1k=mysql_query($sql1k) or die(mysql_error());
$r=mysql_fetch_assoc($res1k);



if(isset($_POST['name']))
{
$name=mysql_real_escape_string(strip_tags(trim($_POST['name'])));
if(empty($name))
{
 echo "<font size=2 color='red'>Please Enter an Album Name</font><br><br>";
}
else
{


$sql1="SELECT name FROM album WHERE id='".$_GET['id']."' AND user='".$_SESSION['uid']."'";
$res1=mysql_query($sql1) or die(mysql_error());
if(mysql_num_rows($res1)>=1)
{
echo "<div id='album_error'><font size=2 color='red'>Album Name Already Exists</font></div><br><br>";
}
else
{
$sqlmmm="UPDATE album SET name='".$name."' WHERE id='".$_GET['id']."')";
mysql_query($sqlmmm) or die(mysql_error());
$sqlcx="UPDATE photos SET album='".$name."' WHERE album='".$r['name']."')";
mysql_query($sqlcx) or die(mysql_error());

echo "<font size=2 color='red'>Album Updated Succesfully</font><br><br>";
}



}

}

?>

Album Name : <input type='text' name='name' value='<?php echo $r['name']?>'> <input type='submit' name='submit' value='Edit'>

</form>

</div>


<?php } ?>


</div>
		


</div>		
		</td>
      </tr>

	  <tr>
	  <td>
	
				
                </td>
              </tr>
				
				</table>
		  </td>
	  </tr>
    </table>


	
 </td>
	  </tr>

<?php
require('footer.php');
							




}
elseif($_GET['view']=='delete')
{
include('config.php');
$sqld="SELECT * FROM photos WHERE id='".$_GET['id']."' LIMIT 1";
$resd=mysql_query($sqld) or die(mysql_error());
$rd=mysql_fetch_assoc($resd);

mysql_query("DELETE FROM photos WHERE id='".$_GET['id']."' LIMIT 1");

if(file_exists('../users/'.$_SESSION['uid'].'/pictures/'.$_GET['album'].'/'.$rd['url']))
{
unlink('../users/'.$_SESSION['uid'].'/pictures/'.$_GET['album'].'/'.$rd['url']);
}


header('location:view.php?view=photos&album='.$_GET['album']);
}
elseif($_GET['view']=='deletealbum' && isset($_GET['album']))
{
include('config.php');

$sqld="SELECT * FROM photos WHERE album='".$_GET['album']."'";
$resd=mysql_query($sqld) or die(mysql_error());
$rd=mysql_fetch_assoc($resd);


function Delete($path)
{
    if (is_dir($path) === true)
    {
        $files = array_diff(scandir($path), array('.', '..'));

        foreach ($files as $file)
        {
            Delete(realpath($path) . '/' . $file);
        }

        return rmdir($path);
    }

    else if (is_file($path) === true)
    {
        return unlink($path);
    }

    return false;
}

$path='../users/'.$_SESSION['uid'].'/pictures/'.$_GET['album'];

Delete($path);

mysql_query("DELETE FROM album WHERE id='".$_GET['id']."' LIMIT 1");
mysql_query("DELETE FROM photos WHERE album='".$_GET['album']."'");



header('location:profile3.php?view=photos&user='.$_SESSION['uid']);
}
}
?>












