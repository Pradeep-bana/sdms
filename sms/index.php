<?php

$apikey = '6cdb336d-9388-487d-aa79-4f46af82c0b4';
$to = '+917223881566';
$to1 = '+917049527566';
$message = 'how are you ?';
$mobile_ip = 'http://100.98.184.227:8082';

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $mobile_ip);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"to\":\"$to,$to1\",\"message\":\"$message\"}");

curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Authorization: ' . $apikey)
);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);