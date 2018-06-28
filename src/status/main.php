<?php
if(!$isMe)die();

require_once(__DIR__.'/info.php');

$load="Load: {$cpu['1']} {$cpu['5']} {$cpu['15']}\n";
$mem='Mem: '.($mem['total'] - $mem['free'])."MB/{$mem['total']}MB (".sprintf('%.2f%%',($mem['total'] - $mem['free'])/$mem['total']*100).")\n";
$disk='Disk: '.($disk['total'] - $disk['free'])."GB/{$disk['total']}GB (".sprintf('%.2f%%',($disk['total'] - $disk['free'])/$disk['total']*100).")\n";
$uptime="Uptime: {$uptime_days} days {$uptime_hours}:{$uptime_minutes}:{$uptime_seconds}\n";

$message=$load.$mem.$disk.$uptime;
$message=rtrim($message);

$sendBack=true;
?>
