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
    case 'cardProduct':
        include 'updateCardProduct.php';
        break;
    case 'provider':
        include 'updateProvider.php';
        break;
    default:
    $result = (object) [
        'success' => false,
        'msg' => 'not type data',
    ];
}
    
echo json_encode($result);

?>