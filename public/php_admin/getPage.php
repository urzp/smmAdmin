<?php

$data=[];

$id_page = $rq_data -> page_id;

$sql = "SELECT * FROM `pages` WHERE `id`='$id_page' ";
$result_sql = $mysql -> query($sql);
$page = $result_sql -> fetch_assoc();
$data['page'] = $page;

$sql = "SELECT * FROM `cardsProduct` WHERE `id_page`='$id_page' ";
$result_sql = $mysql -> query($sql);

$cards=[];
$i=0;
foreach($result_sql as $item){
    $cards[$i] = $item;
    $i++;
}
$data['cards'] = $cards;


$result = (object) [
    'success' => true,
    'data' => $data,
];

?>