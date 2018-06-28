<?php
if(0==$argc)
$message='请提供搜索关键字';
else
$message='https://vndb.org/v/all?q='.urlencode($argvs);

$sendBack = true;
?>