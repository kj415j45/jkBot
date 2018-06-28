<?php
function drawScore($recent, $map, $u){
$exo2='/usr/share/fonts/truetype/exo2/exo2.ttf';
$exo2b='/usr/share/fonts/truetype/exo2/exo2-bold.ttf';
$venera=__DIR__.'/Venera.ttf';

$acc=ACCof($recent);

$bg=getBG('https://bloodcat.com/osu/i/'.$map['beatmap_id']);


addElipse($bg, imagesx($bg)*0.5, imagesy($bg)*0.5, 800, 800, 255, 255, 255, 127*0.20);
$shadow=imagecreatefrompng(__DIR__.'/shadow.png');
imagecopy($bg, $shadow, 225, 0, 0, 0, 829, 720);
addElipse($bg, imagesx($bg)*0.5, imagesy($bg)*0.5, 480, 480, 255, 255, 255, 127*0.60);

$blue=imagecolorallocate($bg, 0x44, 0xAA, 0xDD);
$gray=imagecolorallocate($bg, 0xAA, 0xAA, 0xAA);
$pink=imagecolorallocate($bg, 178, 22, 121);
imagettftext($bg, 25, 0, 290, 360, $blue, $exo2b, $recent['maxcombo'].'x');
imagettftext($bg, 20, 0, 250, 380, $gray, $exo2b, 'max combo');
imagettftext($bg, 25, 0, 905, 360, $blue, $exo2b, $acc);
imagettftext($bg, 20, 0, 905, 380, $gray, $exo2b, 'accuracy');


drawMidText($bg, $exo2b, 20, $gray, 180, $u);
$rank=imagecreatefrompng(__DIR__.'/'.$recent['rank'].'.png');
imagecopy($bg, $rank, 580, 160, 0, 0, 120, 120);


require_once(__DIR__.'/mods.php');
$imgs=getModImages(praseMod($recent['enabled_mods']));
$counts=count($imgs);
if(1==$counts){
imagecopy($bg, $imgs[0], 617, 260, 0, 0, 45, 32);
}
if(2==$counts){
imagecopy($bg, $imgs[0], 595, 260, 0, 0, 45, 32);
imagecopy($bg, $imgs[1], 640, 260, 0, 0, 45, 32);
}
if(3==$counts){
imagecopy($bg, $imgs[0], 617-45, 260, 0, 0, 45, 32);
imagecopy($bg, $imgs[1], 617, 260, 0, 0, 45, 32);
imagecopy($bg, $imgs[2], 617+45, 260, 0, 0, 45, 32);
}
if(4==$counts){
imagecopy($bg, $imgs[0], 595-45, 260, 0, 0, 45, 32);
imagecopy($bg, $imgs[1], 595, 260, 0, 0, 45, 32);
imagecopy($bg, $imgs[2], 640, 260, 0, 0, 45, 32);
imagecopy($bg, $imgs[3], 640+45, 260, 0, 0, 45, 32);
}
if(5==$counts){
imagecopy($bg, $imgs[0], 617-45*2, 260, 0, 0, 45, 32);
imagecopy($bg, $imgs[1], 617-45, 260, 0, 0, 45, 32);
imagecopy($bg, $imgs[2], 617, 260, 0, 0, 45, 32);
imagecopy($bg, $imgs[3], 617+45, 260, 0, 0, 45, 32);
imagecopy($bg, $imgs[4], 617+45*2, 260, 0, 0, 45, 32);
}
if(6==$counts){
imagecopy($bg, $imgs[0], 595-45*2, 260, 0, 0, 45, 32);
imagecopy($bg, $imgs[1], 595-45, 260, 0, 0, 45, 32);
imagecopy($bg, $imgs[2], 595, 260, 0, 0, 45, 32);
imagecopy($bg, $imgs[3], 640, 260, 0, 0, 45, 32);
imagecopy($bg, $imgs[4], 640+45, 260, 0, 0, 45, 32);
imagecopy($bg, $imgs[5], 640+45*2, 260, 0, 0, 45, 32);
}
if(7==$counts){
imagecopy($bg, $imgs[0], 617-45*3, 260, 0, 0, 45, 32);
imagecopy($bg, $imgs[1], 617-45*2, 260, 0, 0, 45, 32);
imagecopy($bg, $imgs[2], 617-45, 260, 0, 0, 45, 32);
imagecopy($bg, $imgs[3], 617, 260, 0, 0, 45, 32);
imagecopy($bg, $imgs[4], 617+45, 260, 0, 0, 45, 32);
imagecopy($bg, $imgs[5], 617+45*2, 260, 0, 0, 45, 32);
imagecopy($bg, $imgs[6], 617+45*3, 260, 0, 0, 45, 32);
}

drawMidText($bg, $venera, $recent['score']/10000000.0>1.0?40:($recent['score']/1000000.0>1.0?50:60), $pink, 360, number_format($recent['score']));
drawMidText($bg, $exo2b, 15, $blue, 395, $map['title']);
drawMidText($bg, $exo2b, 15, $blue, 420, $map['artist']);
drawMidText($bg, $exo2b, 15, $gray, 445, $map['version'].' - mapped by '.$map['creator']);
drawMidText($bg, $exo2b, 12, $pink, 470, 'CS: '.sprintf('%.2f', $map['cs']).'   OD: '.sprintf('%.2f', $map['od']).'   HP: '.sprintf('%.2f', $map['hp']).'   AR: '.sprintf('%.2f', $map['ar']).'   Stars: '.sprintf('%.2f', $map['stars']));
drawMidText($bg, $exo2, 15, $blue, 500, $recent['date']);
drawMidText($bg, $exo2b, 20, $gray, 540, sprintf("%'04d  %'04d  %'04d  %'04d", $recent['count300'], $recent['count100'], $recent['count50'], $recent['countmiss']));
drawMidText($bg, $exo2b, 15, $gray, 560, 'Great     Good      Meh      Miss  ');


$result_pp=getPP($recent['beatmap_id'], $recent);
drawMidText($bg, $exo2b, 30, $blue, 80, $result_pp['pp'].'pp-+==>'.getSSPP($recent['beatmap_id'], $recent).'pp');
drawMidText($bg, $exo2b, 25, $blue, 640, 'aim: '.$result_pp['aim'].'pp');
drawMidText($bg, $exo2b, 25, $blue, 670, 'speed: '.$result_pp['spd'].'pp');
drawMidText($bg, $exo2b, 25, $blue, 700, 'accuracy: '.$result_pp['acc'].'pp');

return $bg;
}
?>