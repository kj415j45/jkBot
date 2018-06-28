<?php
if(getCredit($argv[1]))
$message=QQat((int)$argv[1]).'的余额为'.getCredit($argv[1]);
else $message=QQat((int)$argv[1]).'没有钱！';
?>