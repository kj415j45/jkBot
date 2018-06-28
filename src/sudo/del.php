<?php
unlink(__DIR__."/../{$argv[1]}/{$argv[2]}.php");
if(file_exists(__DIR__."/../{$argv[1]}/{$argv[2]}.php"))
$message="Failed when deleting {$argv[1]}/{$argv[2]}.php";
else $message="Success in deleting {$argv[1]}/{$argv[2]}.php";
?>