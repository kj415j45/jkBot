<?php
require_once(__DIR__.'/../credit/tools.php');

if(!preg_match('/[A-Za-z_]*/', $argv[0]))die();
$template=fopen(__DIR__.'/template/'.$argv[0], 'r');
if(!$template)$message='没有该模版';
else{
$count=(int)$argv[1];
if($count>10||$count<1)$count=1;
for($i=0;$i<$count;$i++){
$num=rand(1, 10000);
while(!feof($template)){
$rule=fgets($template);
sscanf($rule, '%d %d %s', $min, $max, $card);
if($min<=$num&&$num<=$max){
$message.=$card."\n";
break;
}
}
rewind($template);
}

fclose($template);
rtrim($message);
}
$sendBack = true;
?>
