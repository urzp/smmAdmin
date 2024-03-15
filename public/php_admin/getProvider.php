<?php

$id_prov = $rq_data -> provider_id;

$sql = "SELECT * FROM `postavshik` WHERE `id`='$id_prov' ";
$result_sql = $mysql -> query($sql);
while ($row = $result_sql->fetch_assoc()) { 
    $data[] = $row;
}

$result = (object) [
    'success' => true,
    'data' => $data,
];

?>