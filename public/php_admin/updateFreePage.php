<?php

$data = $rq_data -> data;

foreach($data as $item){

    $id = $item -> id;
    $page = $item -> page;
    $id_provider = $item -> id_provider;
    $quantity_max = $item -> quantity_max;
    $newPage = $item -> newPage;

    if($newPage=='1'){
        $sql = "INSERT INTO `pages_free` (`page`, `id_provider`, `quantity_max`) VALUES ('$page', '$id_provider', '$quantity_max')"; 
    }else{
        $sql = "UPDATE `pages_free` SET `page`='$page', `id_provider`='$id_provider', `quantity_max`='$quantity_max' WHERE `id`='$id' ";
    }

    $mysql -> query($sql);

}

$result = (object) [
    'success' => true,
    'data' => '',
];

?>