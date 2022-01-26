<?php
require __DIR__ . '/getMemberInfo.php';
$resetIdStr = $_GET["id"];
$ticket = $_GET["t"];
$res = confirmResetPassword($resetIdStr, $ticket);
$redirectUrl = "https://".$_SERVER['SERVER_NAME']."/#/login";
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>靠北伯夷</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
       <div><?php echo $res -> errMsg; ?></div>
       <a href="<?php echo $redirectUrl; ?>">回到靠北伯夷</a>
    </body>
</html>