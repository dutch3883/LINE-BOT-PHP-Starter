<?php
$access_token = 'BcG4dLjmv2bYTUX5arRis6cE/u7Pv5vVVeTy6cJlrzW4b6f6+BVvqpZA0iFPPyaQGW10mkEA8r1ilnd7zQo861qLN8K8SN3/harFGndNPQj1+lzWXjjlu0Aljsv83yjKzorGr7i7J36SjN9KCXFduQdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
?>