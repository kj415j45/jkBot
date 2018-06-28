<?php
if(!$isMe)die();

$issue=file_get_contents(__DIR__."/issues/{$argv[1]}.txt");
if(false!=$issue){
preg_match_all('/Creator: (\w*)/', $issue, $creator);

$creator=$creator[1][0];

$CoolQ->sendPrivateMsg($creator, '您创建的 issue #'.$argv[1].' 被忽略！');

$message=QQat($creator).' 创建的 Issue #'.$argv[1].' 被忽略！';

unlink(__DIR__."/issues/{$argv[1]}.txt");
}else $message='Issue 不存在';

?>