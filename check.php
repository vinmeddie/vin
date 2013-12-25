<?php
if(empty($_SESSION['uid']))
{
header('location:login.php');
}
?>