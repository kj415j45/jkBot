<?php
if(!$isMe)die();

$issue=file_get_contents(__DIR__."/issues/{$argv[1]}.txt");
if(false!=$issue){
preg_match_all('/Creator: (\w*)/', $issue, $creator);

$creator=$creator[1][0];

$CoolQ->sendPrivateMsg($creator, '您创建的 issue #'.$argv[1].' 已经解决！'."\n".'如果问题仍然存在，请重新创建。附：Issue文件');
$CoolQ->sendPrivateMsg($creator, $issue, true);

$message=QQat($creator).' 创建的 Issue #'.$argv[1].' 已经解决！';

unlink(__DIR__."/issues/{$argv[1]}.txt");
}else $message='Issue 不存在';

?>