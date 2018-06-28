<?php
$code = $content;
mkdir(__DIR__."/../{$argv[1]}");
$filename=$argv[2];

file_put_contents(__DIR__."/../{$argv[1]}/{$filename}.php", $code);
$message="Success in editing {$argv[1]}/{$filename}.php"
?>