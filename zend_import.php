<?php
/**
 * need zend
 */
defined('DS') || define('DS', DIRECTORY_SEPARATOR);
define('BASE_DIR', realpath(__DIR__ ) .DS);
define('DATA_PATH', BASE_DIR.'data/');
require_once './../vendor/autoload.php';
$pdo = new \Zend\Db\Adapter\Driver\Pdo\Pdo(
    [
        'driver' => 'Pdo',
        'dsn' => 'mysql:dbname=devdb_test;host=127.0.0.1',
        'user' => 'test',
        'password' => 'test',
        'charset' => 'utf-8',
        'driver_options' => [
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'
        ],
    ]
);
$db = new \Zend\Db\Adapter\Adapter($pdo);
$table = new \Zend\Db\TableGateway\TableGateway(
    'product_test',
    $db
);
$rowHashes = [];
$fh         = fopen('./data/sample8.csv', 'r');
$title      = fgetcsv($fh, 0, ",", '"');
$title = array_map('trim', $title);
$title = array_map('mb_strtolower', $title);
$i =0;
while ($myIdata = fgetcsv($fh, 0, ",", '"')) {

    $myIdata = array_map('trim', $myIdata);
    $myIdata = array_combine($title, $myIdata);


    try {
        $table->insert($myIdata);
        $i++;

    } catch (\Exception $e) {

        echo $e->getMessage();
        echo '<pre>';
        print_r($e->getTraceAsString());
        echo '</pre>';
        die("FILE:" . __FILE__ . " LINE:" . __LINE__ . " AH");

    }

}

echo'<pre>';print_r($i);echo'</pre>';exit;