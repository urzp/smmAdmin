<?php

$id = $rq_data -> id;

$sql ="DELETE FROM `pages_free` WHERE `id`='$id'";
$result_sql = $mysql -> query($sql);

$result = (object) [
    'success' => true,
    'data' => $sql,
];

?>