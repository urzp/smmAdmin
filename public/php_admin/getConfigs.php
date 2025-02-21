<?php
$site = $rq_data -> site;

$table = 'config';
if($site=='youtikins') $table = 'config_youtikin';

$sql = "SELECT * FROM `$table`";
$sql_result = $mysql -> query($sql);

foreach($sql_result as $item){
    $name_conf =  $item['name'];
    $val_conf = $item['value'];
    $configs[$name_conf] = $val_conf;
}

$result = (object) [
    'success' => true,
    'data' => $configs,
];
?>