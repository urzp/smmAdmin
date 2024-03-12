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

$sql = "SELECT * FROM `users`";
$result_sql = $mysql -> query($sql);
while ($row = $result_sql->fetch_assoc()) {  
    $row['orders'] = countorders($row['id']);
    $row['sum_orders'] = countSumOrders($row['id']);
    $row['registration'] = gerRegUser($row['id']);
    $data[] = $row;
}

$result = (object) [
    'success' => true,
    'data' => $data,
];

?>