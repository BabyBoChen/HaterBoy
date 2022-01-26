<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");

if (isset($_COOKIE["token"])) {
    setcookie("token", null, -1, '/',httponly:true); 
} else {
    setcookie("token", null, -1, '/',httponly:true); 
}

$res = ["isLogin" => false];

echo json_encode($res);
?>