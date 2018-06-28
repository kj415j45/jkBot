<?php
require_once(__DIR__.'/tools.php');

if(file_exists(__DIR__."/{$argv[0]}.php"))
require_once(__DIR__."/{$argv[0]}.php");
else if(''==$argv[0]){
if(getCredit($sender))
$message=QQat($sender).'的余额为'.getCredit($sender);
}else die();

$sendBack = true;
?>