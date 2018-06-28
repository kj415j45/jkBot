<?php
$balance=getCredit($sender);
$forward=(int)$argv[2];
if($forward<0)$message='转账金额不能为负';
else if($balance<$forward)$message='余额不足';
else{
creditAdd((int)$argv[1], $forward);
creditAdd($sender, -$forward);
$message='转账给'.QQat((int)$argv[1]).'成功，您的余额为'.getCredit($sender);
}
?>