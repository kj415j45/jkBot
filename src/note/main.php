<?php
if(!$isMe)die();

file_put_contents(__DIR__.'/'.date('Y-m-d ',time()).$argvs.'.txt', $content);
?>