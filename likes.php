<?php
session_start();
?>
<?php
include('check.php');
include('config.php');

if(isset($_GET['user']) && $_GET['user']!='' && isset($_GET['id']) && $_GET['id']!='' && isset($_GET['st']) && $_GET['st']=='like')
{

$rr=mysql_query("SELECT * FROM m_like WHERE post_id='".$_GET['id']."' AND user='".$_GET['user']."'");
if(mysql_num_rows($rr)=='0')
{

mysql_query("INSERT INTO m_like VALUES('','".$_GET['id']."','".$_GET['user']."')");
header('location:chat.php');
}

}
elseif(isset($_GET['user']) && $_GET['user']!='' && isset($_GET['id']) && $_GET['id']!='' && isset($_GET['st']) && $_GET['st']=='unlike')
{

mysql_query("DELETE FROM m_like WHERE post_id='".$_GET['id']."' AND user='".$_GET['user']."'") or die(mysql_error());
header('location:chat.php');
}

elseif(isset($_GET['user']) && $_GET['user']!='' && isset($_GET['id']) && $_GET['id']!='' && isset($_GET['st']) && $_GET['st']=='likee')
{

$rr=mysql_query("SELECT * FROM m_like WHERE post_id='".$_GET['id']."' AND user='".$_GET['user']."'");
if(mysql_num_rows($rr)=='0')
{

mysql_query("INSERT INTO m_like VALUES('','".$_GET['id']."','".$_GET['user']."')");
header('location:comment.php?id='.$_GET['id']);
}

}
elseif(isset($_GET['user']) && $_GET['user']!='' && isset($_GET['id']) && $_GET['id']!='' && isset($_GET['st']) && $_GET['st']=='unlikee')
{

mysql_query("DELETE FROM m_like WHERE post_id='".$_GET['id']."' AND user='".$_GET['user']."'") or die(mysql_error());
header('location:comment.php?id='.$_GET['id']);
}
elseif(isset($_GET['id']) && $_GET['id']!='' && isset($_GET['st']) && $_GET['st']=='del')
{
mysql_query("DELETE FROM m_chat WHERE id='".$_GET['id']."' ") or die(mysql_error());
mysql_query("DELETE FROM m_like WHERE post_id='".$_GET['id']."' ") or die(mysql_error());
mysql_query("DELETE FROM m_comments WHERE post_id='".$_GET['id']."' ") or die(mysql_error());

header('location:chat.php');
}


?>