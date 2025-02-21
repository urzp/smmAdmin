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

    if($newPage=='1'){
        $sql = "INSERT INTO `$table` (`page`, `id_provider`, `quantity_max`) VALUES ('$page', '$id_provider', '$quantity_max')"; 
    }else{
        $sql = "UPDATE `$table` SET `page`='$page', `id_provider`='$id_provider', `quantity_max`='$quantity_max' WHERE `id`='$id' ";
    }

    $mysql -> query($sql);

}

$result = (object) [
    'success' => true,
    'data' => '',
];

?>