<?php

$sql = "SELECT * FROM `postavshik`";
$result_sql = $mysql -> query($sql);
while ($row = $result_sql->fetch_assoc()) { 
    $data[] = $row;
}

$result = (object) [
    'success' => true,
    'data' => $data,
];

?>