<?php
require_once(__DIR__.'/tools.php');
require_once(__DIR__.'/draw.php');
$u=null;
if(isset($recvMsgs[1]))
$u=$recvMsgs[1];
else if(getBindID($sender))
$u=getBindID($sender);

$bp=get_user_best($k, $u, (int)$argv[1]);
if(null==$bp)$message='玩家不存在或无该bp';
else{
$map=get_map($bp['beatmap_id'], $bp['enabled_mods']);
$map['beatmap_id']=$bp['beatmap_id'];

$bg=drawScore($bp, $map, $u);


$base64_img=gd2base64($bg, $recv['message_id']);
$message="[CQ:image,file=base64://{$base64_img}]";

}
?>