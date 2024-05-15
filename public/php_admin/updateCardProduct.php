<?php

$data = $rq_data -> data;

$id_card = $data -> id;
$type = $data -> type;
$id_provider = $data -> id_provider;
$id_servis = $data -> id_servis;


$sql = "UPDATE `cardsProduct` SET `type`='$type', `id_provider`='$id_provider', `id_servis`='$id_servis'  WHERE `id`='$id_card' ";
$mysql -> query($sql);

$params = $data -> params;
foreach($params as $item){
    $id = $item -> id;
    $name = $item -> name;
    $value = $item -> value;
    if($id=="new"){
        $sql = "INSERT INTO `cardProductParams` (`id_card`, `name`, `value`) VALUES ('$id_card', '$name', '$value')";
    }else{
        $sql = "UPDATE `cardProductParams` SET `name`='$name', `value`='$value'  WHERE `id`='$id' ";
    }
    $mysql -> query($sql);
}

$card_params_to_delete = $data -> card_params_to_delete;
foreach($card_params_to_delete as $id){
    $sql ="DELETE FROM cardProductParams WHERE `id`='$id'";
    $mysql -> query($sql);
}

$result = (object) [
    'success' => true,
    'data' => '',
];

?>