<?php
if(!$isMe)die();

$t1 = microtime(true);

$target=$argv[0];
$flowCount=$argv[1];
$delay=$argv[2];

for($i=0;$i<$flowCount;$i++){
$CoolQ->sendPrivateMsg($target, $content);
usleep($delay);
}

$t2 = microtime(true);

$message='Time: '.(($t2-$t1)*1000).'ms';
$sendBack=true;

?>