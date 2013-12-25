<?php
//get user
function getuser($table,$wanted,$field,$user_id)
{
$sql=mysql_query("SELECT * FROM $table WHERE $field='".$user_id."'") or die(mysql_error());
while($res=mysql_fetch_assoc($sql))
{
return $res[$wanted];
}
}
//end get user






?>