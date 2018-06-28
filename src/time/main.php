<?php
//尝试修正时区到日本（
date_default_timezone_set('Asia/Tokyo');

$minute=(int)date('i');
$hour=(int)date('H');
if($minute>=45)$hour++;
if($hour==24)$hour=0;

if($isMe && null!=$argv[0]){
if(file_exists(__DIR__."/{$argv[0]}.php"))
require_once(__DIR__."/{$argv[0]}.php");
else die();
}else{
$CoolQ->sendGroupMsg($group, '[CQ:record,file=base64://'.base64_encode(file_get_contents(__DIR__."/record/{$hour}.mp3")).']');
if(file_exists(__DIR__."/{$hour}.php"))
require_once(__DIR__."/{$hour}.php");
else die();
}

$sendBack=true;
?>