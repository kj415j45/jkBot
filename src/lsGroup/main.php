<?php
if(!$isMe)die();

$groupList=json_decode($CoolQ->getGroupList(), true)['data'];
$message=var_export($groupList,true);

$sendBack=true;
?>