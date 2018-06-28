<?php
if(!preg_match('/[a-zA-Z0-9_]{1,}/', $argv[0]))die();

require_once(__DIR__.'/../credit/tools.php');
if(file_exists(__DIR__."/{$argv[0]}")){
if(!file_exists(__DIR__."/{$argv[0]}/{$sender}")){
file_put_contents(__DIR__."/{$argv[0]}/{$sender}", '');
$reward=(int)file_get_contents(__DIR__."/{$argv[0]}/reward");
creditAdd($sender, $reward);
$message='密码正确，获得'.$reward.'金币';
}else{
$message='你已经兑换过了';
}
}else{
$message='密码不正确';
}

$sendPM=true;
?>