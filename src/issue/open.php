<?php
$issue_ok=false;
mkdir(__DIR__.'/issues/');
$index=file_get_contents(__DIR__.'/issues/index');
if(!$index)$index=1;
$index=(int)$index;

$desc=$content;

if(strlen($title)>1&&strlen($title)<70&&strlen($desc)<1000)$issue_ok=true;

if($issue_ok){
file_put_contents(__DIR__."/issues/{$index}.txt", "Issue #{$index}\nCreator: {$sender}\n{$desc}");

$message=$sender.' 创建了 issue #'.$index;
$CoolQ->sendPrivateMsg($me, $message);
$message=QQat($sender).' 创建了 issue #'.$index;

$index++;
file_put_contents(__DIR__.'/issues/index', $index);
}else{
$message='Issue 不符合要求';
}
?>