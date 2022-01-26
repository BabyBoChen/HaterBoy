<?php 
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
require __DIR__ . '/getMemberInfo.php';

$chats = getAllChats();

echo json_encode($chats);

?>