<?php 
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
require __DIR__ . '/getMemberInfo.php';

$uid = -1;
$password = '';
$nickname = '';
$msg = '';
$newUserInfo = new UserInfo();

$userInfo = getJWT();
if ($userInfo -> isLogin == true){
    $uid = $userInfo -> uid;
    $pwd = $_POST["Password"];
    $nickname = $_POST["Nickname"];
    $res = updateMember($uid, $pwd, $nickname);
    if($res == true){
        $msg = "會員資料更新成功！";
        $newUserInfo = getMemberInfoById($uid);
        $newUserInfo -> rem = $userInfo -> rem;
        $newUserInfo -> exp = $userInfo -> exp;
        updateToken($newUserInfo);
    }else{
        $msg = "會員資料更新失敗，請洽詢站長伯夷！";
    }
}else{
    $msg = "請登入會員後再試一次！";
}

echo $msg;
?>