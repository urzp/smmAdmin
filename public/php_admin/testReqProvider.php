<?php

$id_prov = $rq_data -> id_old_provider;
$sql = "SELECT `name`, `api_key` FROM `postavshik` WHERE  `id_old` = '$id_prov'";
$sql_result = $mysql -> query($sql);
$sql_result = $sql_result -> fetch_assoc();
$api_key = $sql_result['api_key'];
$url_prov = $sql_result['name'];

$request = $rq_data -> data;
$request -> key = $api_key;
    
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => $url_prov,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => http_build_query($request)
));
$res = curl_exec($curl);
if(curl_error($curl)){
    $errMes = curl_error($curl);
};
curl_close($curl);

if(isset($errMes)) {
    $result_provider = (object) ["status" => "false", "message" => $errMes];
} else {
    $res_msg = json_decode($res,true);
    if(isset($res_msg['error'])){
        $result_provider = (object) ["status" => "false", "message" => $res];
    }else{
        if (str_contains($res, 'error')) {
            $result_provider = (object) ["status" => "false", "message" => $res];
        }else{
            $result_provider = (object) ["status" => "success", "message" => $res];
        }
    }
    
}
    //echo $result_provider -> status.'<br>';

$result = (object) [
    'success' => $result_provider -> status,
    'data' =>  json_decode($result_provider -> message, true),
    //'success' => 'true',
    //'msg' => $request,
];

?>