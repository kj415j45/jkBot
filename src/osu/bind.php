<?php
if(isset($recvMsgs[1]))
if(null != get_user($k, $recvMsgs[1]))
if(!file_exists(__DIR__.'/user/'.$sender)){
file_put_contents(__DIR__.'/user/'.$sender, trim($recvMsgs[1]));
$message='成功绑定'.rtrim($recvMsgs[1]).'到'.$sender;
}
else $message='您已经绑定了'.getBindID($sender).'，如有错误请开issue';
else $message='没有该玩家的信息';
else $message='请填写 osu!ID';
$sendBack=true;
?>