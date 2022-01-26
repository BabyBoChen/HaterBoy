<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");

require __DIR__ . '/getMemberInfo.php';

$email = $_POST["Email"];
$password = $_POST["Password"];
$rememberMe = filter_var($_POST["RememberMe"], FILTER_VALIDATE_BOOLEAN);

$user = userLogin($email, $password);

if ($user != null){

    if ($rememberMe == true){
        $user -> rem = 1;
    }
    
    setJWT($user);
    
    echo "1|OK";
}else{
    echo "0|FAILED";
}

?>