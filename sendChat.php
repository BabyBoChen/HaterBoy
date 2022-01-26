<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
require __DIR__ . '/getMemberInfo.php';

$userInfo = getJWT();
if($userInfo -> isLogin){
    $uid = $userInfo -> uid;
    $chatContent = $_POST["ChatContent"];
    $res = sendChat($uid, $chatContent);    
}else{
    $res = new ResponseMsg();
    $res -> isSuccess = false;
    $res -> errMsg = "張貼失敗！請重新登入會員或洽詢管理員";
}

echo json_encode($res);
?>