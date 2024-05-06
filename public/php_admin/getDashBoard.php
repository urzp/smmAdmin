<?php

$data = [];
$orders = [];

function countTotal($type_data, $condition = ''){
    global $mysql;
    $sql = "SELECT COUNT(id) FROM `$type_data` $condition";
    $result_sql = $mysql -> query($sql); 
    $result_sql = $result_sql -> fetch_assoc();
    return $result_sql['COUNT(id)'];
}

function countDay($type_data, $dayFrom){
    global $mysql;
    $beginTime = date('Y-m-d',strtotime("-".$dayFrom." days"));
    $endTime = $beginTime." 23:59:59";
    $sql = "SELECT COUNT(id) FROM `$type_data` WHERE `datetime`>= '$beginTime' AND `datetime`<= '$endTime' ";
    if($type_data == 'users') $sql = "SELECT COUNT(id) FROM `user_log` WHERE `action`='new user' AND `date_time`>= '$beginTime' AND `date_time`<= '$endTime' ";
    $result_sql = $mysql -> query($sql); 
    $result_sql = $result_sql -> fetch_assoc();
    return $result_sql['COUNT(id)'];    
}

function getGraphic($type_data){
    $result = [];
    for($i=0; $i<7; $i++){
        $result[$i] = countDay($type_data, $i);
    }
    return $result;
}

$users['total'] = countTotal('users');
$users['today'] = countDay('users', 0);
$users['graphic'] = getGraphic('users');
$data['users'] = $users;

$orders['total'] = countTotal('orders');
$orders['today'] = countDay('orders', 0);
$orders['graphic'] = getGraphic('orders');
$data['orders'] = $orders;

$ordersUsers['total'] = countTotal('out_payments');
$ordersUsers['today'] = countDay('out_payments', 0);
$ordersUsers['graphic'] = getGraphic('out_payments');
$data['ordersUsers'] = $ordersUsers;

$servis['pages'] = countTotal('pages', "WHERE `cards`>'0' ");
$servis['total'] = countTotal('cardsProduct');
$data['servis'] = $servis;

$provader['total'] = countTotal('postavshik');
$data['provader'] = $provader;

$result = (object) [
    'success' => true,
    'data' => $data,
];


?>