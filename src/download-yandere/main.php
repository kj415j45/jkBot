<?php
require_once(__DIR__.'/../credit/tools.php');

if(!file_exists(__DIR__.'/download.lock')){
file_put_contents(__DIR__.'/download.lock', $sender);

ini_set('max_execution_time', 0);

$jpegQuality=(int)(isset($recvMsgs[2])?$recvMsgs[2]:75);
$balance=getCredit($sender);
if(!($jpegQuality >= 0 && $jpegQuality <=100))
  $jpegQuality=75;
if($jpegQuality>=75) $fee=50 - (75 - $jpegQuality)*2;
else $fee=50 - (int)((75-$jpegQuality)/3);
if($balance > $fee ){
setCredit($sender, $balance - $fee); //扣除手续费

require_once(__DIR__.'/cos-php-sdk-v5/cos-autoloader.php');
$cosClient = new Qcloud\Cos\Client(array('region' => 'ap-hongkong',
    'credentials'=> array(
	'appID' => 'yandere-1252915719',
        'secretId'    => rtrim(file_get_contents(__DIR__.'/id')),
        'secretKey' => rtrim(file_get_contents(__DIR__.'/secret')))));

$tags=urlencode($argvs);
$result=json_decode(file_get_contents("https://yande.re/post.json?tags=order%3Arandom%20{$tags}&page={$recvMsgs[1]}"), true);
$count=count($result);
//$message=var_export($result,true);

mkdir(__DIR__.'/'.$hash);
for($i=0;$i<$count;$i++){
$image=imagecreatefromstring(file_get_contents($result[$i]['file_url']));
imagejpeg($image, __DIR__."/{$hash}/{$result[$i]['id']}.jpg", $jpegQuality);
if(($i+1)%5==0) $CoolQ->sendPrivateMsg($sender, '下载进度：'.($i+1).'/'.$count);
}
exec('cd '.__DIR__."/ && zip -r {$hash}.zip {$hash}/*");
try {
    $UploadResult = $cosClient->upload(
        $bucket='yandere-1252915719',
        $key = "{$hash}.zip",
        $body=fopen(__DIR__."/{$hash}.zip",'r+'));
    //print_r($result);
    $message='下载地址：'."yandere-1252915719.file.myqcloud.com/{$hash}.zip\n".'下载了'.$count.'张图片'."\n".'您的余额为:'.getCredit($sender);
    exec('cd '.__DIR__."/ && rm -r {$hash}");
    } catch (\Exception $e) {
    $message="文件上传失败";
    setCredit($sender, $balance);
}
unlink(__DIR__.'/download.lock');
$sendPM=true;
}else{
$message='余额不足';
$sendBack=true;
}
}else{
$message='有任务进行中，请稍后再试';
$sendBack=true;}
?>
