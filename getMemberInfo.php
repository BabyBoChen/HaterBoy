<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/secret.php';
use PHPMailer\PHPMailer\PHPMailer;
use Firebase\JWT\JWT;

class UserInfo{
    
    public bool $isLogin = false;
    public string $iss = "babybochen";
    public string $sub = "haterBoy";
    public int $uid = -1;
    public ?string $aud = null;
    public ?string $pwd = null;
    public ?string $usr = null;        
    public array $rol = [3];
    public int $rem = 0;
    public ?int $exp = null;

    function toJWT() : string {
        $key = getSecret()["key"];
        $payload = array(
            "iss" => $this-> iss,
            "sub" => $this-> sub,
            "uid" => $this-> uid,
            "aud" => $this-> aud,
            "usr" => $this-> usr,
            "rol" => $this-> rol,
            "rem" => $this-> rem,
            "exp" => time() + (60*60*24*3),
        );
        $jwt = JWT::encode($payload, $key, getSecret()["algo"]);
        return $jwt;
    }

    function toDict() : array {
        $userInfoDict = array(
            "isLogin" => $this -> isLogin,
            "id" => $this-> uid, 
            "email" => $this-> aud,
            "password" => $this -> pwd, 
            "rememberMe" => $this -> rem,
            "nickname" => $this-> usr,
            "roles" => $this-> rol,
        );
        return $userInfoDict;
    }
}

class ResponseMsg{
    public bool $isSuccess = false;
    public string $errMsg = "";

    function toJson() : string{
        $res = array(
            "isSuccess" => $this -> isSuccess,
            "errMsg" => $this -> errMsg,
        );
        return json_encode($res);
    }
}

class Chat{
    public int $id = 0;
    public int $memberId = 0;
    public string $nickname = "";
    public string $chatContent = "";
    public ?DateTime $createdDateTime = null;
    public string $createdDate = "";
}

function mySqlConnection() : mysqli{    

    $servername = getSecret()["servername"];
    $username = getSecret()["username"];
    $dbPassword = getSecret()["dbPassword"];
    $dbname = getSecret()["dbname"];

    // Create connection
    $conn = new mysqli($servername, $username, $dbPassword, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;    
}

function userLogin(string $email, string $password) : ?UserInfo {

    // Create connection
    $conn = mySqlConnection();

    $sql = "SELECT * FROM member WHERE Email = '$email' AND Password = '$password';";

    $result = $conn->query($sql);

    $userInfos = array();

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            
            $user = new UserInfo();
            $user -> isLogin = true;
            $user -> uid = intval($row["Id"]);
            $user -> aud = $row["Email"];
            $user -> usr = $row["Nickname"];
            
            array_push($userInfos, $user);
        }
    } else {
        
    }

    $conn->close();    

    if(count($userInfos) > 0){
        return $userInfos[0];
    }else{
        return null;
    }
}

function getUserInfoDict(UserInfo $userInfo) : array {
    $userInfoDict = array(
        "isLogin" => $userInfo -> isLogin,
        "id" => $userInfo-> uid, 
        "email" => $userInfo-> aud,
        "password" => $userInfo -> pwd, 
        "nickname" => $userInfo-> usr,
        "roles" => $userInfo-> rol,
    );
    return $userInfoDict;
}

function getMemberInfoById(int $id) : ?UserInfo{
    $conn = mySqlConnection();
    $sql = "SELECT * FROM member WHERE Id=$id;";
    $result = $conn->query($sql);
    $userInfos = array();

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            
            $user = new UserInfo();
            $user -> isLogin = true;
            $user -> uid = intval($row["Id"]);
            $user -> aud = $row["Email"];
            $user -> pwd = $row["Password"];
            $user -> usr = $row["Nickname"];
            
            array_push($userInfos, $user);
        }
    } else {
        
    }

    $conn->close();
    if(count($userInfos) > 0){
        return $userInfos[0];
    }else{
        return null;
    }
}

function setJWT(UserInfo $userInfo){

    $userInfo -> exp = time() + (3 * 24 * 60 * 60);
    $cookie_expire = time() + (3 * 24 * 60 * 60);
    $jwt = $userInfo -> toJWT();
    if ( $userInfo -> rem == 1){
        setcookie(name:"token", value:$jwt, expires_or_options:$cookie_expire, httponly:true);
    }else{
        setcookie(name:"token", value:$jwt, expires_or_options:0, httponly:true);
    }
}

function getJWT() : UserInfo {

    $token = new UserInfo();
    $key = getSecret()["key"];

    if (isset($_COOKIE["token"])){
        $jwt = $_COOKIE["token"];
        try{
            $decoded = (array)JWT::decode($jwt, $key, array(getSecret()["algo"]));
            if ($decoded["iss"] == "babybochen" && $decoded["sub"] == "haterBoy"){
                $token -> isLogin = true;                
                $token -> uid = intval($decoded["uid"]);
                $token -> aud = $decoded["aud"];
                $token -> usr = $decoded["usr"];
                $token -> rol = $decoded["rol"];
                $token -> rem = intval($decoded["rem"]);
                $token -> exp = intval($decoded["exp"]);

            }else{
                setcookie("token", null, -1, '/',httponly:true);
                $token -> isLogin = false;                                
            }
        }catch(Exception $e){
            
            setcookie("token", null, -1, '/',httponly:true);
            $token -> isLogin = false;
        }
            
    }else{
        setcookie("token", null, -1, '/',httponly:true);
        $token -> isLogin = false;
    }

    return $token;
}

function updateToken(UserInfo $userInfo){

    $cookie_expire = $userInfo -> exp;
    $jwt = $userInfo -> toJWT();
    if ( $userInfo -> rem == 1){
        setcookie(name:"token", value:$jwt, expires_or_options:$cookie_expire, httponly:true);
    }else{
        setcookie(name:"token", value:$jwt, expires_or_options:0, httponly:true);
    }
}

function updateMember(int $uid, string $password, string $nickname){
    $conn = mySqlConnection();
    $sql = "UPDATE member SET `Password`='$password', `Nickname`='$nickname' WHERE `Id`=$uid;";
    $result = $conn->query($sql);
    if($result === true){
        return true;
    }else{
        return false;
    }
}

function register(string $email, string $password, string $nickname) : ResponseMsg {
    $resMsg = new ResponseMsg();
    $conn = mySqlConnection();

    $sql = "SELECT Email FROM member WHERE Email = ?";
    $stmt = $conn -> prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $res = $stmt->get_result();
    while ($row = $res->fetch_array(MYSQLI_NUM)) {
        $resMsg -> isSuccess = false;
        $resMsg -> errMsg .= "????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????";
        return $resMsg;
    }    

    $sql = "INSERT INTO register(`Md5`,`Email`,`Password`,`Nickname`) VALUES(?, ?, ?, ?)";
    $md5 = md5(microtime());
    $stmt = $conn -> prepare($sql);
    $stmt->bind_param("ssss",$md5, $email, $password, $nickname);
    try{
        $res = $stmt->execute();
    }catch (Exception $e){
        $resMsg -> isSuccess = false;
        $resMsg -> errMsg .= $conn->error."insert";
    }
    
    if($res === true){
        $lastId = $conn -> insert_id;
        try{
            sendVerifyEmail($email, $nickname, $lastId ,$md5);
            $resMsg -> isSuccess = true;
            $resMsg -> errMsg = "???????????????????????????????????????????????????????????????";
        }catch(Exception $e){
            $err = $e -> getMessage();
            $resMsg -> errMsg .= $err."mail";
        }
    }
    $conn -> close();
    return $resMsg;
}

function sendVerifyEmail(string $email, string $nickname, int $lastId, string $md5){
    ob_start();
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->Charset = 'UTF-8';
    $mail->SMTPDebug  = 0;  
    $mail->SMTPAuth   = true;
    $mail->Host       = "smtp-relay.sendinblue.com";
    $mail->Username   = getSecret()["mainUsername"];
    $mail->Password   = getSecret()["mainPassword"];
    $mail->Port       = 587;
    $mail->IsHTML(true);
    $mail->AddAddress($email, $nickname);
    $mail->AddCC(getSecret()["mainUsername"], "BabyBoFood");
    $mail->SetFrom(getSecret()["mainUsername"], "BabyBoFood");
    $mail->AddReplyTo(getSecret()["mainUsername"], "BabyBoFood");
    $mail->Subject = "=?utf-8?B?" . base64_encode("??????????????????????????????") . "?=";
    $verifyUrl = '';
    if ($_SERVER['HTTP_HOST'] == "localhost"){
        $verifyUrl = "http://localhost/verify.php?id=$lastId&m=$md5";
    }else{
        $verifyUrl = "https://babybofood.000webhostapp.com/verify.php?id=$lastId&m=$md5";
    }    
    $content = "<h2> $nickname ?????????????????????????????????????????????????????????</h2>
                <a href='$verifyUrl'>????????????</a>";
    $mail->MsgHTML($content); 
    $mail->Send();
    ob_end_clean();
}

function verifyEmail(int $id, string $md5) : ResponseMsg{
    $resMsg = new ResponseMsg();
    $conn = mySqlConnection();

    $sql = <<<EOD
    INSERT INTO member(`Email`, `Password`, `Nickname`)
    SELECT `Email`, `Password`, `Nickname`
    FROM register
    WHERE `Id` = $id AND `Md5` = '$md5'
    EOD;

    $res = $conn -> query($sql);
    if($res === true){
        $resMsg -> isSuccess = true;
        $resMsg -> errMsg = "?????????????????????";
    }else{
        $resMsg -> isSuccess = false;
        if ($conn -> errno == 1062){
            $resMsg -> errMsg = "??????????????????????????????";
        }else{
            $resMsg -> errMsg = $conn -> error;
        }
    }    

    return $resMsg;
}

function resetPassword(string $email) : ResponseMsg{
    $res = new ResponseMsg();
    $res -> isSuccess = true; 

    $conn = mySqlConnection();
    $sql = "SELECT * FROM member WHERE `Email` = ?";
    $stmt = $conn -> prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result != false && $result -> num_rows >= 1){
        $uid = -1;
        while($row = $result->fetch_assoc()){
            $uid = $row["Id"];
            break;
        }

        try{
            $md5 = md5(microtime());
            $newPassword = substr($md5,0,8);
            $ticket = substr($md5,8,4);
            $sql = "INSERT INTO reset_pwd(`MemberId`,`NewPassword`,`Ticket`) VALUES(?,?,?)";
            $stmt = $conn -> prepare($sql);
            $stmt->bind_param("iss", $uid, $newPassword,$ticket);
            $exec =  $stmt->execute();
            if($exec == true){
                $reset_pwd_id = $conn->insert_id;
                resetEmail($email, $reset_pwd_id, $newPassword, $ticket);
            }
            
        }catch (Exception $e){
            $res -> errMsg .= $e -> getMessage();
            return $res;
        }
               
    }
    
    $conn -> close();
    $res -> errMsg .= "??????????????????????????????????????????????????????????????????????????????????????????????????????";
    return $res;
}

function resetEmail(string $email, int $reset_pwd_id, string $newPassword, string $ticket){
    $ticket = urlencode($ticket);
    $resetUrl = "https://".$_SERVER['SERVER_NAME']."/resetPassword.php?id=$reset_pwd_id&t=$ticket";
    ob_start();
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->Charset = 'UTF-8';
    $mail->SMTPDebug  = 0;  
    $mail->SMTPAuth   = true;
    $mail->Host       = "smtp-relay.sendinblue.com";
    $mail->Username   = getSecret()["mainUsername"];
    $mail->Password   = getSecret()["mainPassword"];
    $mail->Port       = 587;
    $mail->IsHTML(true);
    $mail->AddAddress($email);
    $mail->AddCC(getSecret()["mainUsername"], "BabyBoFood");
    $mail->SetFrom(getSecret()["mainUsername"], "BabyBoFood");
    $mail->AddReplyTo(getSecret()["mainUsername"], "BabyBoFood");
    $mail->Subject = "=?utf-8?B?" . base64_encode("??????????????????????????????") . "?=";    
    $content = "<h2>??????????????????????????????????????????????????????????????????????????????????????????</h2>
                <p>????????????</p>
                <p>$newPassword</p>
                <a href='$resetUrl'>??????????????????</a>
                <div>????????????????????????????????????????????????????????????????????????</div>";
    $mail->MsgHTML($content); 
    $mail->Send();
    ob_end_clean();
}

function confirmResetPassword(string $reset_pwd_id_str, string $ticket) : ResponseMsg{
    $res = new ResponseMsg();
    
    try{
        $reset_pwd_id = intval($reset_pwd_id_str); 
        $conn = mySqlConnection();
        $sql = "SELECT * FROM reset_pwd WHERE `Id` = ? AND `Ticket` = ?;";
        $stmt = $conn -> prepare($sql);
        $stmt->bind_param("is",$reset_pwd_id, $ticket);
        $stmt->execute();
        $result = $stmt->get_result();
        $memberId = 0;
        $newPassword = null;
        while($row = $result ->fetch_assoc()){
            $memberId = intval($row["MemberId"]);
            $newPassword = $row["NewPassword"];
        }
        if($memberId != 0 && $newPassword != null && strlen($newPassword) >= 8 ){
            $sql = "UPDATE member SET `Password` = ? WHERE `Id` = ?;";
            $stmt = $conn -> prepare($sql);
            $stmt->bind_param("si",$newPassword, $memberId);
            $exec = $stmt->execute();            
            if($exec == true){
                $res -> errMsg .= "???????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????";
            }else{
                throw new Exception('??????????????????????????????????????????????????????error code: 1');
            }
        }else{
            throw new Exception('??????????????????????????????????????????????????????error code: 2');
        }
        $conn -> close();
        $res -> isSuccess = true;
    }catch(Exception $e){
        $res -> errMsg = $e -> getMessage();
        $res -> isSuccess = false;
    }

    return $res;
}

function getAllChats() : array {
    
    $chats = [];

    $conn = mySqlConnection();
    $sql = "SELECT chat.Id, member.Id AS MemberId, member.Nickname, 
        chat.ChatContent, chat.CreatedDate 
        FROM chat 
        JOIN member ON chat.MemberId = member.Id 
        WHERE chat.IsHidden = 0
        ORDER BY chat.CreatedDate DESC
        LIMIT 20";
    $result = $conn -> query($sql);
    if($result == true){
        $rows = $result -> fetch_all(MYSQLI_ASSOC);
        foreach($rows as $row){
            $chat = new Chat();
            $chat -> id = $row["Id"];
            $chat -> memberId = $row["MemberId"];
            $chat -> nickname = $row["Nickname"];
            $chat -> chatContent = $row["ChatContent"];
            $chat -> createdDate = $row["CreatedDate"];
            $dtObj = date_create_from_format('Y-m-d H:i:s', $row["CreatedDate"]);
            if($dtObj != false){
                $chat -> createdDateTime = $dtObj;
            }
            
            array_push($chats, $chat);
        }
    }
    
    $conn -> close();
    return $chats;

}

function sendChat(int $memberId, string $chatContent) : ResponseMsg{
    $res = new ResponseMsg();

    $conn = mySqlConnection();
    $sql = "INSERT INTO chat(`MemberId`, `ChatContent`) VALUES(?, ?)";
    $stmt = $conn -> prepare($sql);
    $stmt->bind_param("is",$memberId, $chatContent);
    try{
        $result = $stmt->execute();
        if($result != false){
            $res -> isSuccess = true;
            $res -> errMsg .= "???????????????????????????";
        }else{
            $res -> isSuccess = false;
            $res -> errMsg .= "something went wrong...";
        }
    }catch(Exception $e){
        $res -> isSuccess = false;
        $res -> errMsg .= $e -> getMessage();        
    }

    $conn -> close();

    return $res;
}

function delChat(int $memberId, int $chatId) : ResponseMsg{
    $res = new ResponseMsg();

    $conn = mySqlConnection();
    $sql = "UPDATE chat SET `isHidden` = 1 WHERE `Id` = ? AND `MemberId` = ? LIMIT 1;";
    $stmt = $conn -> prepare($sql);
    $stmt->bind_param("ii",$chatId, $memberId);
    try{
        $result = $stmt->execute();
        $rows = $conn -> affected_rows;
        if($result == true && $rows > 0){
            $res -> isSuccess = true;
            $res -> errMsg .= "??????????????????$chatId ???????????????????????????($rows)";
        }else{
            $res -> errMsg .= "?????????????????????";
        }
    }catch(Exception $e){
        $res -> isSuccess = false;
        $res -> errMsg .= $e -> getMessage();        
    }
    $conn -> close();
    return $res;
}
?>