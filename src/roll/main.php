<?php
if('132783429'==$group)die();

$min=1;
$max=100;
if(2==$argc){
$min=$argv[0];
$max=$argv[1];
}
if(1==$argc)$max=$argv[0];

$message=rand((int)$min, (int)$max);
$sendBack = true;
?>