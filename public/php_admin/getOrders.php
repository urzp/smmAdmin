<?php
$until = $rq_data -> date_until;
$until = $until.' 23:59:59';
$from = $rq_data -> date_from; 

$sql = "SELECT * FROM `orders` WHERE `datetime` <= '$until' AND `datetime` >= '$from' ORDER BY `id` DESC";
$result_sql = $mysql -> query($sql);
while ($row = $result_sql->fetch_assoc()) {  
    $data[] = $row;
}

$result = (object) [
    'success' => true,
    'data' => $data,
    'debag' => $sql,
];

?>