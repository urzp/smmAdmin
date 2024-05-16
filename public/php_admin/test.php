<?php
header('Access-Control-Allow-Origin: *');
$api_key = $_POST['api_k'];
$payment = $_POST['payment'];
$payment = json_decode(str_replace('\"', "",$payment), true);
$transaction = $payment['orderid'];
$sum = $payment['amount'];
$products = $payment['products'][0];

echo json_encode($_POST);

?>