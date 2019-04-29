#!/usr/bin/php
<?php

function progress_bar($done, $total, $info="", $width=50) {
    $perc = round(($done * 100) / $total);
    $bar = round(($width * $perc) / 100);
    return sprintf("%s%%[%s>%s]%s\r", $perc, str_repeat("=", $bar), str_repeat(" ", $width-$bar), $info);
}

defined('DS') || define('DS', DIRECTORY_SEPARATOR);
define('BASE_DIR', realpath(__DIR__ ) .DS);
define('DATA_PATH', BASE_DIR.'data/');
define('IMG_PATH', BASE_DIR.'images/');

if ('cli' != php_sapi_name()) {

    throw new Exception('This has to be run from the command line');
}
?>
***********************************************************************
************************ Kommandozeilenskript *************************
***********************************************************************
Befehle:
-help    zeigt diese Hilfe an

<?php
//$files = glob(DATA_PATH."*.{csv,xlsx,xls}", GLOB_BRACE);
$files = glob(DATA_PATH."*.{csv}", GLOB_BRACE);


if($files) {

    foreach ($files as $fileAndPath) {

    }
}