<?php

$site = $rq_data -> site;

$table = 'pages_free';
if($site=='youtikins') $table = 'pages_free_youtikin';

$sql = "SELECT * FROM `$table`";
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