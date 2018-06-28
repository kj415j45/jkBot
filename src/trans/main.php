<?php
require_once(__DIR__.'/GoogleTranslate.php');
use \Statickidz\GoogleTranslate;

$trans = new GoogleTranslate();
$message=$trans->translate($argv[0], $argv[1], $content);

$sendBack=true;
?>