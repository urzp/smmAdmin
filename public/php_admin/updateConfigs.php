<?php

$data = $rq_data -> data;

$site = $rq_data -> site;

$table = 'config';
if($site=='youtikins') $table = 'config_youtikin';

$returnData;
foreach($data as $name => $value) {
    $sql = "UPDATE `$table` SET `value`='$value'  WHERE `name`='$name'";
    $mysql -> query($sql);
}

$result = (object) [
    'success' => true,
    'data' => '',
];

?>