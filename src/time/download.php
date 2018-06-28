<?php

$files=file_get_contents(__DIR__.'/files');
$files=explode("\n", $files);

mkdir(__DIR__.'/record');
for($i=0;$i<24;$i++){
exec('cd '.__DIR__."/record/ && wget {$files[$i]} -O {$i}.mp3");
}
?>
