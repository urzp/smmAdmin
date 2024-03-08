<?php
function countorders($id_user){
    global $mysql;
    $sql =" SELECT COUNT(id) from out_payments WHERE `id_user`='$id_user'";
    $result_sql = $mysql -> query($sql); 
    $result_sql = $result_sql -> fetch_assoc();
    return $result_sql['COUNT(id)'];
}


$sql = "SELECT * FROM `users`";
$result_sql = $mysql -> query($sql);
while ($row = $result_sql->fetch_assoc()) {  
    $row['orders'] = countorders($row['id']);
    $data[] = $row;
}

$result = (object) [
    'success' => true,
    'data' => $data,
];

?>