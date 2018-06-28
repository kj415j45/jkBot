<?php
require_once(__DIR__.'/blur.php');
require_once(__DIR__.'/mods.php');
function getBG($url){
$bg=imagecreatefromstring(file_get_contents($url));
if(!$bg)$bg=imagecreatefromjpeg(__DIR__.'/bg.jpg');
$resize_bg=imagecreatetruecolor(1280, 720);
imageantialias($resize_bg, true);
imagecopyresized($resize_bg, $bg, 0, 0, 0, 0, 1280, 720, imagesx($bg), imagesy($bg));

imagefilter($resize_bg, IMG_FILTER_BRIGHTNESS, -50);
blur($resize_bg, 3);
//imagefilter($resize_bg, IMG_FILTER_GAUSSIAN_BLUR, 7.5);
return $resize_bg;
}
function addElipse($im, $x, $y, $w, $h, $r, $g, $b, $a=0){
imagefilledellipse($im, $x, $y, $w, $h, imagecolorallocatealpha($im, $r, $g, $b, $a));
}
function ACCof($m){
$acc=(300*$m['count300']+
      100*$m['count100']+
      50*$m['count50'])/
	  (300*($m['count300']+$m['count100']+$m['count50']+$m['countmiss']));
return sprintf('%.2f%%', $acc*100);
}
function drawMidText($im, $font, $size, $color, $y, $text){
$box=imagettfbbox($size, 0, $font, $text);
$point=(imagesx($im)-$box[2])/2;
imagettftext($im, $size, 0, $point, $y, $color, $font, $text);
}
function getPP($map, $stat){

$mods=getMODstring($stat['enabled_mods']);
exec("curl https://osu.ppy.sh/osu/{$map} | oppai - ".(null!=$mods?"+{$mods}":'')." {$stat['count100']}x100 {$stat['count50']}x50 {$stat['countmiss']}m {$stat['maxcombo']}x -ojson", $result);
$result=json_decode($result[0], true);
return [
'pp'=>sprintf('%.2f', $result['pp']),
'aim'=>sprintf('%.2f', $result['aim_pp']),
'spd'=>sprintf('%.2f', $result['speed_pp']),
'acc'=>sprintf('%.2f', $result['acc_pp']),
];
}
function getSSPP($map, $stat){
$mods=getMODstring($stat['enabled_mods']);
exec("curl https://osu.ppy.sh/osu/{$map} | oppai - ".(null!=$mods?"+{$mods}":'')." 100% -ojson", $result);
return sprintf('%.2f', json_decode($result[0], true)['pp']);
}
function get_user_recent($k, $u){
$u=urlencode(trim($u));
return json_decode(file_get_contents("https://osu.ppy.sh/api/get_user_recent?k={$k}&u={$u}"), true)[0];
}
function get_user_best($k, $u, $bp){
$u=urlencode(trim($u));
return json_decode(file_get_contents("https://osu.ppy.sh/api/get_user_best?k={$k}&u={$u}&limit={$bp}"), true)[$bp-1];
}
function get_user($k, $u){
$u=urlencode(trim($u));
return json_decode(file_get_contents("https://osu.ppy.sh/api/get_user?k={$k}&u={$u}"), true)[0];
}
function get_map($id, $mod){
$mods=getMODstring($mod);
exec("curl https://osu.ppy.sh/osu/{$id} | oppai - -ojson ".(null!=$mods?"+{$mods}":''), $result);
return json_decode($result[0], true);
}
function getBindID($qq){
return file_get_contents(__DIR__.'/user/'.$qq);
}

?>