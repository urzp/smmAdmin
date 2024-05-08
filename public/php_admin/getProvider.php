<?php

include 'getAdminUserLevel.php';

if($user_level=='admin'){
    $sql = "SELECT * FROM `postavshik`";
}else{
    $sql = "SELECT `id`, `id_old`, `balans`, `currency` FROM `postavshik`";
}

$id_prov = $rq_data -> provider_id;

$result_sql = $mysql -> query($sql);
while ($row = $result_sql->fetch_assoc()) { 
    $data[] = $row;
}

$result = (object) [
    'success' => true,
    'data' => $data,
];

?>