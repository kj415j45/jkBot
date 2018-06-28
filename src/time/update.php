<?php

if(!$isMe)die();
$web=file_get_contents($content);
if(!$web)die();

preg_match_all('/https:\/\/img\.moegirl\.org\/common\/\S{1}\/\S{2}\/[a-zA-Z0-9_]*\.mp3/', $web, $result);
$start=count($result[0])-24-1;
for($i=$start;$i<$start+24;$i++)
$files.=$result[0][$i]."\n";
file_put_contents(__DIR__.'/files', $files);

preg_match_all('/[0-9]{4}：[ \S]*<\/span><br>(?:[0-9]{4}：)?([ \S]*)/', $web, $result);
for($i=0;$i<24;$i++)
$times.=preg_replace('/<[\S ]*>[\s\S]*<\/\S*>/','',$result[1][$i])."\n";
file_put_contents(__DIR__.'/times', $times);

require_once(__DIR__.'/textUpdate.php');
require_once(__DIR__.'/download.php');
require_once(__DIR__.'/prepare.php')
?>