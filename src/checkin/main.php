<?php
require_once('credit/tools.php');
$last=fileatime('credit/user/'.$sender);
if($last && 0==(int)date('d')-(int)date('d', $last)){
$message='你今天签到过了';
}else{
$addition=rand(10, 25);
creditAdd($sender, $addition);
$message='签到成功，获得'.$addition.'金币';
}
$sendBack=true;
?>