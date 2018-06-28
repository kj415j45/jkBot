<?php

$times=file_get_contents(__DIR__.'/times');
$times=explode("\n", $times);

for($i=0;$i<24;$i++){
file_put_contents(__DIR__."/{$i}.php", '<?php'."\n".'$message=\''.$times[$i]."';\n?>");
}

$message='Success in update!';

?>
