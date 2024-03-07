<?php

include '../php/config.php';

header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json");

$post = file_get_contents("php://input");
$post = json_decode($post);


$email = $post-> email;
$password = $post -> password;

$session = md5($email.rand(0,1000));




$sql = "SELECT `id` FROM `admin` WHERE `email` = '$email' && `password`='$password'";
$checkUser = $mysql -> query($sql);
$checkUser = $checkUser -> fetch_assoc();


if(isset($checkUser)){
	$userId = $checkUser['id'];
    $sql = "UPDATE `admin` SET `token` = '$session' WHERE `id` = '$userId'";
	$result = (object) [
		'success' => true,
		'session' => $session,
		'user' => $checkUser,
	];
	
	$mysql -> query($sql);
}else{
	$result = (object) [
		'success' => false,
		'error' => 'user',
	];
}

$mysql->close();
echo json_encode($result);

?>
