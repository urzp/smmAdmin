<?php

$data = $rq_data -> data;

$id = $data -> id;
$id_old = $data -> id_old;
$name = $data -> name;
$api_key = $data -> api_key;

if($id=='new'){
    $sql = "INSERT INTO `postavshik` (`id_old`, `name`, `api_key`) VALUES ('$id_old', '$name', '$api_key')"; 
}else{
    $sql = "UPDATE `postavshik` SET `id_old`='$id_old', `name`='$name', `api_key`='$api_key' WHERE `id`='$id' ";
}


$mysql -> query($sql);

$result = (object) [
    'success' => true,
    'data' => '',
];

?>