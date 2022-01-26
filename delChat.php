<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
require __DIR__ . '/getMemberInfo.php';

$userInfo = getJWT();
$chatId = intval($_GET["chatId"]);
$res = new ResponseMsg();
if($userInfo -> isLogin == true && $chatId != 0){
    $uid = $userInfo -> uid;
    $res = delChat($uid, $chatId);
}else{
    $res -> isSuccess = false;
    $res -> errMsg = "刪除失敗！請重新登入會員或洽詢管理員";
}

echo json_encode($res);
?>