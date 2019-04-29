<?php
define('API_URL', 'https://api.kontakt.io/device?maxResult=500');
define('API_KEY', 'qACdYylEwNrbLbkPXbMnGljEopUafbkB');

$blacklist = ["UvRu","SyuP","icyq","3ANo","IjkS","Eo0N","Gtkf","wbG9","Gtkf","wbG9"];

// get result from API call
$ch = curl_init(API_URL);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt(
    $ch,
    CURLOPT_HTTPHEADER,
    [
        'Api-Key: ' . API_KEY,
        'Accept: application/vnd.com.kontakt+json;version=10',
    ]
);
$response = curl_exec($ch);

$json = json_decode($response, true);
$beacons = $json['devices'];

$fh = fopen('./data/data.txt', 'w+');
$i = 0;
foreach ($beacons as $beacon) {
    // filter test devices
    if (true == in_array($beacon['uniqueId'], $blacklist)) {
        continue;
    }

    $data = [
        'contact_io_id' => $beacon['uniqueId'],
        'mac_address' => $beacon['mac'],
        'uuid' => $beacon['proximity'],
        'type' => $beacon['product'],
    ];

    if (++$i == 1) {
        fputcsv($fh, array_keys($data), "\t", '"');
    }

    fputcsv($fh, $data, "\t", '"');
}
fclose($fh);

echo'<pre>';print_r($beacons);echo'</pre>';exit;