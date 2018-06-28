<?php
function creditAdd($target, $count){
return setCredit($target, getCredit($target)+$count);
}
function getCredit($t){
return (int)file_get_contents(__DIR__.'/user/'.$t);
}
function setCredit($t, $c){
return file_put_contents(__DIR__.'/user/'.$t, $c);
}
?>