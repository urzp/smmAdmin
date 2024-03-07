<?php
include '../php/config.php';

header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json");

$post = file_get_contents("php://input");
$post = json_decode($post);


$user_id = $post-> user_id;
$session = $post -> session;


$sql = "SELECT `id` FROM `admin` WHERE `id` = '$user_id' && `token`='$session'";
$checkUser = $mysql -> query($sql);
$checkUser = $checkUser -> fetch_assoc();

$result = false;
if(isset($checkUser)){$result = true;}

$mysql->close();
echo json_encode($result);

?>
