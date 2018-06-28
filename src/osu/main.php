<?php
//if(!$isMe)die();
$osu='https://osu.ppy.sh';


$k=rtrim(file_get_contents(__DIR__.'/key'));
require_once(__DIR__.'/tools.php');

if(file_exists(__DIR__."/{$argv[0]}.php"))
require_once(__DIR__."/{$argv[0]}.php");
else die();

$sendBack=true;
?>
