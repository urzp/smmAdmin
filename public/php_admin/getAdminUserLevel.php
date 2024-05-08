<?php

$sql = "SELECT `level` FROM `admin` WHERE `id` = '$user_id' && `token`='$session'";
$user = $mysql -> query($sql);
$user = $user -> fetch_assoc();

$user_level = $user['level'];


?>