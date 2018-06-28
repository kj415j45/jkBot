<?php
require_once(__DIR__.'/tools.php');
require_once(__DIR__.'/draw.php');
$u=null;
if(isset($recvMsgs[1]))
$u=$recvMsgs[1];
else if(getBindID($sender))
$u=getBindID($sender);

$recent=get_user_recent($k, $u);
if(null==$recent)$message='玩家不存在或最近无成绩';
else{
$map=get_map($recent['beatmap_id'], $recent['enabled_mods']);
$map['beatmap_id']=$recent['beatmap_id'];

$bg=drawScore($recent, $map, $u);


$base64_img=gd2base64($bg, $recv['message_id']);
$message="[CQ:image,file=base64://{$base64_img}]";
}
?>