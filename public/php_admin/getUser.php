<?php
function countorders($id_user){
    global $mysql;
    $sql =" SELECT COUNT(id) from out_payments WHERE `id_user`='$id_user'";
    $result_sql = $mysql -> query($sql); 
    $result_sql = $result_sql -> fetch_assoc();
    return $result_sql['COUNT(id)'];
}

function countSumOrders($id_user){
    global $mysql;
    $sql ="SELECT SUM(sum) from out_payments WHERE `id_user`='$id_user'";
    $result_sql = $mysql -> query($sql); 
    $result_sql = $result_sql -> fetch_assoc();
    return $result_sql['SUM(sum)'];
}

function gerRegUser($id_user){
    global $mysql;
    $sql = "SELECT `date_time` FROM `user_log` WHERE `id_user`='$id_user' AND `action`='new user' ";
    $result_sql = $mysql -> query($sql);
    $result_sql = $result_sql -> fetch_assoc();
    return $result_sql['date_time'];
}

$id_user = $rq_data -> user_id;

$sql = "SELECT * FROM `users` WHERE `id`='$id_user' ";
$result_sql = $mysql -> query($sql);
$data = $result_sql -> fetch_assoc();
$data['orders'] = countorders($id_user);
$data['sum_orders'] = countSumOrders($id_user);
$data['registration'] = gerRegUser($id_user);

$result = (object) [
    'success' => true,
    'data' => $data,
];

?>