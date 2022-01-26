<?php
require __DIR__ . '/getMemberInfo.php';
$id =  intval($_GET["id"]);
$md5 = $_GET["m"];

$res = verifyEmail($id, $md5);
?>

<html>
    <head>
        <?php
            if($res -> isSuccess == true){
                echo '<meta http-equiv="refresh" content="3;url=https://babybofood.000webhostapp.com/#/login" />';
            }            
        ?>        
    </head>
    <body>
        <?php 
            $msg = $res -> errMsg;
            if ($res -> isSuccess == true){                
                echo "<h1>$msg</h1><p>即將跳轉至靠北伯夷會員登入頁面...</p>";
            }else{
                echo "<p>$msg</p>";
            }

        ?>
    </body>
</html>