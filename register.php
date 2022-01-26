<?php 
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
require __DIR__ . '/getMemberInfo.php';
$email = $_POST["email"];
$password = $_POST["password"];
$nickname = $_POST["nickname"];
$res = register($email,$password,$nickname);
echo json_encode($res);
?>
