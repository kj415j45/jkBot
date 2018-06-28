<?php
$tags=urlencode($argvs);

$result=json_decode(file_get_contents("https://yande.re/post.json?tags=order%3Arandom%20{$tags}"), true);
if(null==$result){
$result=json_decode(file_get_contents("https://yande.re/tag.json?order=count&limit=10&name={$argvs}"), true);
$count=count($result);
if(0==$count)
$message='没有找到结果(无修正建议)';
else{
$message='您要搜索的是不是：'."\n";
for($i=0;$i<$count;$i++)
$message.="{$result[$i]['name']}: {$result[$i]['count']}幅作品\n";
$message=rtrim($message);
}
}else{
$count=count($result);
$i=0;
if(null!=$group){
while($i<$count){
if('s'!=$result[$i]['rating'])
$i++;
else break;
}
}
if($i==$count)
$message='没有找到结果(-1)';
else{
//$base64_img=base64_encode(file_get_contents($result[$i]['sample_url']));
$message="ID: {$result[$i]['id']}\nAuthor: {$result[$i]['author']}\nScore: {$result[$i]['score']}\nTags: {$result[$i]['tags']}[CQ:image,file={$result[$i]['sample_url']}]";
}
}
$sendBack=true;
?>