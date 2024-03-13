<?php

$until = $rq_data -> date_until;
$until = $until.' 23:59:59';
$from = $rq_data -> date_from; 

$id_user = $rq_data -> user_id;

$sql = "SELECT * FROM `in_payments` WHERE `id_user`='$id_user' AND `datetime` <= '$until' AND `datetime` >= '$from' ORDER BY `id` DESC ";
$result_sql = $mysql -> query($sql);
while ($row = $result_sql->fetch_assoc()) {  
    $data[] = $row;
}

$result = (object) [
    'success' => true,
    'data' => $data,
];

?>