<?php

$sql = "SELECT `levle` FROM `admin` WHERE `id` = '$user_id' && `token`='$session'";
$user = $mysql -> query($sql);
$user = $user -> fetch_assoc();

if(!isset($user)||$user['level']!='admin') { 
	$result = (object) [
		'success' => false,
		'error' => 'access',
	];
	echo json_encode($result);
	exit(); 
}

?>