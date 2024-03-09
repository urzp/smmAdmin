<?php

$sql = "SELECT * FROM `orders`";
$result_sql = $mysql -> query($sql);
while ($row = $result_sql->fetch_assoc()) {  
    $data[] = $row;
}

$result = (object) [
    'success' => true,
    'data' => $data,
];

?>