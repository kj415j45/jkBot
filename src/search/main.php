<?php
if(0==$argc){
$message='请提供搜索关键字';
}else{
$query=urlencode($argvs);
$baidu='https://www.baidu.com/s?wd='.$query;
$google='https://www.google.com/search?q='.$query;

$message="谷歌：{$google}\n百度：{$baidu}";
}

$sendBack = true;
?>