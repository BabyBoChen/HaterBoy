<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");

require __DIR__ . '/getMemberInfo.php';

$userInfo = getJWT();

// if($userInfo -> isLogin == true){
//     refreshToken($userInfo);
// }

$userInfoDict = $userInfo -> toDict();

echo json_encode($userInfoDict);

?>