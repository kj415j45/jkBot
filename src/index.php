<?php

$start_time=microtime(true);

require_once '../Autoloader.php';
require_once 'tools.php';

//use CoolQSDK\CoolQSDK;

$message = null;

require_once(__DIR__.'/init.php');

$recv = json_decode(file_get_contents('php://input'), true);

$me = trim(whoisMe());

if(isset($recv['flag'])){
if('group'==$recv['request_type']){
$CoolQ->sendPrivateMsg($me, 'Being invited to group: '.$recv['group_id']);
$CoolQ->setGroupAddRequest($recv['flag'], $recv['sub_type']);
}
if('friend'==$recv['request_type']){
$CoolQ->sendPrivateMsg($me, 'Being friends with: '.$recv['user_id']);
$CoolQ->setFriendAddRequest($recv['flag'], true);
}
}

//将消息解码成原始字符串
$recvMsg = html_entity_decode($recv['message']);

if($recv['user_id']!=$me && preg_match('/\[CQ:\S*\]/', $recvMsg))die();
$recvMsg=remove_emoji($recvMsg);

//存储消息的按行分割版本
$recvMsgs = explode("\r\n", $recvMsg);

//取出首行，并验证是否是命令
$commands = $recvMsgs[0];
if('!' != $commands[0])die();

if(isset($recvMsgs[1]))
$content = substr($recvMsg, strlen($commands)+2);

//取出命令实体
sscanf($commands, '!%s', $command);
$argvs=substr($commands, strlen($command)+2);

//消息环境变量
$botQQ='2839098896';
$sender = $recv['user_id'];
$group = isset($recv['group_id'])?$recv['group_id']:null;

$isMe = belongGroup($sender, 'me');
$sendBack = false;
$sendPM = false;
$hash=$recv['message_id'];
$argvs = str_replace(' --DEBUG', '', $argvs, $count); //去除调试标记以免影响后续处理
$debug = $count;
$argv = explode(' ', $argvs); //$argv是参数表
$argc = count($argv);
//if($debug)$argc--;
if('' == $argv[0])$argc=0;
$rawSend = false;

//弱智反射
if(file_exists(__DIR__."/{$command}/main.php"))
require_once(__DIR__."/{$command}/main.php");
else{
if(!in_array($group, [
'140072310',
'132783429',
'609602961',
])){
$message='[CQ:image,file=error.jpg]';$sendBack=true;}}

if($sendBack){
  if(null !== $group){
    $CoolQ->sendGroupMsg($group, $message, $rawSend);
  }else{
    $CoolQ->sendPrivateMsg($sender, $message, $rawSend);
  }
}else if($sendPM){
  $CoolQ->sendPrivateMsg($sender, $message, $rawSend);
}

$end_time=microtime(true);

//发送调试信息
if($debug && $isMe)
$CoolQ->sendPrivateMsg($me, var_export($recv, true)."\n!{$command} ".var_export($argv, true)."\n".var_export($recvMsgs, true)."\nTime: ".(($end_time-$start_time)*1000).'ms', true);

//$CoolQ->sendPrivateMsg($sender, $message);
?>
