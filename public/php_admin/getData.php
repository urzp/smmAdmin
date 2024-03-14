<?php
include '../php/config.php';
header('Access-Control-Allow-Origin: *');
$post = file_get_contents("php://input");
$post = json_decode($post);
$user_id = $post-> user_id;
$session = $post -> session;
include 'checkAccess.php';

$rq_data = $post -> rq_data;
$typeData = $rq_data -> typeData;

switch ($typeData) {
    case 'providers':
        include 'getProviders.php';
        break;
    case 'dashBoard':
        include 'getDashBoard.php';
        break;
    case 'userLog':
        include 'getUserLog.php';
        break;
    case 'userPaumentBalans':
        include 'getUserPaumentBalans.php';
        break;
    case 'userOrders':
        include 'getUserOrders.php';
        break;
    case 'user':
        include 'getUser.php';
        break;
    case 'users':
        include 'getUsers.php';
        break;
    case 'orders':
        include 'getOrders.php';
        break;
    default:
    $result = (object) [
        'success' => false,
        'msg' => 'not type data',
    ];
}

echo json_encode($result);

?>