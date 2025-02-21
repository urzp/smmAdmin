<?php

$id = $rq_data -> id;

$site = $rq_data -> site;

$table = 'pages_free';
if($site=='youtikins') $table = 'pages_free_youtikin';

$sql ="DELETE FROM `$table` WHERE `id`='$id'";
$result_sql = $mysql -> query($sql);

$result = (object) [
    'success' => true,
    'data' => $sql,
];

?>