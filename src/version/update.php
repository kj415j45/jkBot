<?php
if(!$isMe)die();
file_put_contents(__DIR__.'/version', $content);

$message='Updated to '.$content;
$sendBack = true;
?>