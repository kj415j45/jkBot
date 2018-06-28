<?php

$maxID=23394;
$crypko='https://s.crypko.ai/c/';
$id=(isset($argv[0])&&(int)$argv[0]!=0?(int)$argv[0]:rand(1,$maxID));
$web=file_get_contents($crypko.$id);
preg_match('<meta property="og:image" content="(\S*)">',$web,$result);
$img=$result[1];

$message="Crypko Link: {$crypko}{$id}\n[CQ:image,file={$img}]";
$sendBack=true;
?>