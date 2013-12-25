<?php
include('config.php');
mysql_query("DELETE FROM messages WHERE msgfrom='0' OR msgto='0' ");

?>