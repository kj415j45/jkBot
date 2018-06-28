<?php
if(!$isMe)die();

exec($argvs, $output);
$message=var_export($output, true);

$sendPM=true;
?>