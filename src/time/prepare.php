<?php
for($i=0;$i<24;$i++)
$CoolQ->sendPrivateMsg($me, '[CQ:record,file=base64://'.base64_encode(file_get_contents(__DIR__."/record/{$i}.mp3")).']');
?>