<?php

$id_user = $rq_data -> user_id;

$sql = "SELECT * FROM `out_payments` WHERE `id_user`='$id_user' ";
$result_sql = $mysql -> query($sql);
while ($row = $result_sql->fetch_assoc()) {  
    $data[] = $row;
}

$result = (object) [
    'success' => true,
    'data' => $data,
];

?>