<?php

$data = $rq_data -> data;

$site = $rq_data -> site;

$table = 'pages_free';
if($site=='youtikins') $table = 'pages_free_youtikin';

foreach($data as $item){

    $id = $item -> id;
    $page = $item -> page;
    $id_provider = $item -> id_provider;
    $quantity_max = $item -> quantity_max;
    $newPage = $item -> newPage;
    $pause_h = $item -> pause_h;
    $probability_winning = $item -> probability_winning;

    if($newPage=='1'){
        $sql = "INSERT INTO `$table` (`page`, `id_provider`, `quantity_max`, `pause_h`, `probability_winning`) VALUES ('$page', '$id_provider', '$quantity_max', $pause_h, $probability_winning)"; 
    }else{
        $sql = "UPDATE `$table` SET `page`='$page', `id_provider`='$id_provider', `quantity_max`='$quantity_max', `pause_h`='$pause_h', `probability_winning`='$probability_winning' WHERE `id`='$id' ";
    }

    $mysql -> query($sql);

}

$result = (object) [
    'success' => true,
    'data' => '',
];

?>