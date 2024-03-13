<?php
$type_orders = $rq_data -> typeOrders;
$until = $rq_data -> date_until;
$until = $until.' 23:59:59';
$from = $rq_data -> date_from; 

$sql = '';

if($type_orders=='not_users'){ 
    $table_orders = 'orders';
    $sql = "SELECT * FROM `$table_orders` WHERE `datetime` <= '$until' AND `datetime` >= '$from' ORDER BY `id` DESC";
}

if($type_orders=='users'){ 
    $table_orders = 'out_payments';
    $sql = "SELECT * FROM `$table_orders` WHERE `datetime` <= '$until' AND `datetime` >= '$from' ORDER BY `id` DESC";
}


$result_sql = $mysql -> query($sql);
while ($row = $result_sql->fetch_assoc()) {  
    if($type_orders=='users'){
        $id_user = $row['id_user'];
        $sql = "SELECT `email` FROM `users` WHERE `id`= '$id_user' ";
        $req_email = $mysql -> query($sql);
        $req_email = $req_email -> fetch_assoc();
        $row['user_email'] = $req_email['email'];
    }
    $data[] = $row;
}

$result = (object) [
    'success' => true,
    'data' => $data,
];

?>