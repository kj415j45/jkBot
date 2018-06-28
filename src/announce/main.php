<?php
if(!$isMe)die();

$groupList=json_decode($CoolQ->getGroupList(), true)['data'];
$count=count($groupList);
for($i=0;$i<$count;$i++)
$CoolQ->sendGroupMsg($groupList[$i]['group_id'], $content);

$message="Announced {$count} group(s)";

$sendBack=true;
?>