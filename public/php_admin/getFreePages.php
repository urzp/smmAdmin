<?php

$sql = "SELECT * FROM `pages_free`";
$result_sql = $mysql -> query($sql);

$data=[];
foreach($result_sql as $item){
    array_push($data, $item);
}

$result = (object) [
    'success' => true,
    'data' => $data,
];

?>