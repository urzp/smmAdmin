<?php

function getCards($page_id){
    $reult = [];
    global $mysql;
    $sql = "SELECT * FROM `cardsProduct` WHERE `id_page`='$page_id'";
    $result_sql = $mysql -> query($sql);
    while ($item = $result_sql->fetch_assoc()) {  
        array_push($reult, $item);
    }
    return $reult;
}

function getPages($folder_id){
    $reult = [];
    global $mysql;
    $sql = "SELECT * FROM `pages` WHERE `folder_id`='$folder_id'";
    $result_sql = $mysql -> query($sql);
    while ($item = $result_sql->fetch_assoc()) {  
        $cards = getCards($item['id']);
        $item['cards'] = $cards;
        array_push($reult, $item);
    }
    return $reult;
}

//-------------------------------------

$data = [];

$sql = "SELECT * FROM `folders` WHERE `cards`>'0' ";
$result_sql = $mysql -> query($sql);
while ($item = $result_sql->fetch_assoc()) {  
    $pages = getPages($item['id']);
    $item['pages'] = $pages;
    array_push($data, $item);
}


$result = (object) [
    'success' => true,
    'data' => $data,
];


?>