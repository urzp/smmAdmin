<?php

include 'getAdminUserLevel.php';

$id_prov = $rq_data -> provider_id;

if($user_level=='admin'){
    $sql = "SELECT * FROM `postavshik` WHERE `id`='$id_prov'";
}else{
    $sql = "SELECT `id`, `id_old`, `balans`, `currency` FROM `postavshik` WHERE `id`='$id_prov'";
}



$result_sql = $mysql -> query($sql);
while ($row = $result_sql->fetch_assoc()) { 
    $data[] = $row;
}

$result = (object) [
    'success' => true,
    'data' => $data,
];

?>