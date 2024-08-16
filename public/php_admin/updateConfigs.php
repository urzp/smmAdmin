<?php

$data = $rq_data -> data;

$returnData;
foreach($data as $name => $value) {
    $sql = "UPDATE `config` SET `value`='$value'  WHERE `name`='$name'";
    $mysql -> query($sql);
}

$result = (object) [
    'success' => true,
    'data' => '',
];

?>