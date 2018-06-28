<?php
$kernelVer='kjBot/Frame 1.2.1 Bubble';

if(0==$argc){
$message=file_get_contents(__DIR__.'/version')."\nBase on ${kernelVer}";
}else{
if(file_exists(__DIR__."/{$argv[0]}.php"))
require_once(__DIR__."/{$argv[0]}.php");
else die();
}

$sendBack = true;
?>