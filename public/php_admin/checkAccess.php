<?php

$sql = "SELECT `id` FROM `admin` WHERE `id` = '$user_id' && `token`='$session'";
$user = $mysql -> query($sql);
$user = $user -> fetch_assoc();

if(!isset($user)) { 
	$result = (object) [
		'success' => false,
		'error' => 'access',
	];
	echo json_encode($result);
	exit(); 
}

?>