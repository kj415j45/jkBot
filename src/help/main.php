<?php
if(0==$argc){
if('132783429'==$group)die();
require_once(__DIR__.'/kjBot.php');
$sendPM=true;
if(null!==$group)
$CoolQ->sendGroupMsg($group, QQat($sender).' 请查看私聊');
}else{
if(file_exists(__DIR__."/{$argv[0]}.php"))
require_once(__DIR__."/{$argv[0]}.php");
else $message='没有该命令的帮助信息';
$sendBack = true;
}
?>