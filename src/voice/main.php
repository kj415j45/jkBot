<?php
$lang=$argv[0];
if(2!=strlen($lang))die();

file_put_contents("{$hash}.txt", $text);
exec("gtts-cli -f {$hash}.txt -o {$hash}.mp3 -l {$lang}");

$base64_mp3=base64_encode(file_get_contents($hash.'.mp3'));
$message="[CQ:record,file=base64://{$base64_mp3}]";

unlink($hash.'.mp3');
unlink($hash.'.txt');

$sendBack = true;
?>
