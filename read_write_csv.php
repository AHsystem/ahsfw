<?php
function progress_bar($done, $total, $info="", $width=50) {
    $perc = round(($done * 100) / $total);
    $bar = round(($width * $perc) / 100);
    return sprintf("%s%%[%s>%s]%s\r", $perc, str_repeat("=", $bar), str_repeat(" ", $width-$bar), $info);
}
set_time_limit(0);
$search =['40 400 27','40 400 15','25 555 25','25 555 01'];

defined('DS') || define('DS', DIRECTORY_SEPARATOR);
define('BASE_DIR', realpath(__DIR__ ) .DS);
define('DATA_PATH', BASE_DIR.'data/');
define('IMG_PATH', BASE_DIR.'images/');
$header = true;
$fhr         = fopen('./data/test1.csv', 'r');
$fhw         = fopen('./data/test2.csv', 'w+');
//$title      = fgetcsv($fh, 0, "|", '"');
//$title = array_map('trim', $title);
//$title = array_map('mb_strtolower', $title);
$fp = file('./data/artikel.csv');
$ccvCount =  count($fp);
$fieldnames = explode('|', 'art_lfdnr|art_nr|art_bez_001|art_bez_002|');
$i =0 ;

echo $len =count($fieldnames)." Field<br/>";
//fputcsv($fhr, array_keys($fieldnames), ",", '"');
fputcsv($fhw, $fieldnames, ",", '"');
while ($row = fgetcsv($fhr, 0, "|", '"')) {




    $len =count($row);
    //        $row = array_map('trim', $row);
    if(in_array($row[1], $search) ){
        $save_rwo = $row;
    }else {
        continue;
    }
//    if($header){
//        if (++$i == 1) {
//            fputcsv($fhw, array_keys($row), ",", '"');
//        }
//    }

	$i++;
    fputcsv($fhw, $save_rwo, ",", '"');
//    echo progress_bar($i,$ccvCount,"Count:".$i);
    
}
echo $len." row<br/>";
fclose($fhw);
fclose($fhr);

