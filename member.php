<?php 
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
require __DIR__ . '/getMemberInfo.php';
$token = getJWT();
if($token -> isLogin == true){    
    $userInfo = getMemberInfoById($token -> uid);
    $userInfoDict = getUserInfoDict($userInfo);
}else{
    $userInfo = new UserInfo();
    $userInfoDict = getUserInfoDict($userInfo);
}
echo json_encode($userInfoDict);
?>