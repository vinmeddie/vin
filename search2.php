<?php 
session_start();
?>
<?php
include('config.php');
if(isset($_POST['search']))
{

$er=array();

if(empty($er))
{
$sqlt="SELECT * FROM users WHERE username LIKE '%".$_POST['search']."%' AND username!='NULL'";
$rest=mysql_query($sqlt) or die(mysql_error());
$top=mysql_num_rows($rest);
if(mysql_num_rows($rest)==0)
{
$t="<font color='orange'>no results found</font>";
$td="<font color='black'>Try searching using a <b>Username</b></font>";
}
elseif(mysql_num_rows($rest)==1)
$t="<font color='orange'>".$top." result found</font>";
else
$t="<font color='orange'>".$top." results found</font>";

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



echo "<font size=2><a href='profile3.php?view=info&user=".ucfirst($row['id'])."'><p left:5px;>&nbsp;&nbsp;&nbsp;&nbsp;".ucfirst(strtolower($row['username']))."</p> </font>";

}


}
else
{

foreach($er as $r)
{
echo "<font size=2 color='red'>".$r."</font>";
}


}



}
?>
