<?php

$sql = "SELECT * FROM `orders` ORDER BY `id` DESC";
$result_sql = $mysql -> query($sql);
while ($row = $result_sql->fetch_assoc()) {  
    $data[] = $row;
}

$result = (object) [
    'success' => true,
    'data' => $data,
];

?>