<?php
include("sql.inc.php");
echo '
<main class="mdl-layout__content mdl-color--grey-100">
<div class="mdl-dialog__content">
';
$id = $_SESSION['nick'];
$acc = "SELECT * FROM svList_account WHERE nick = '$id'";
$result1 = mysql_query($acc);
$rowss = mysql_fetch_row($result1);
if ($rowss[8] == 10){
    mysql_query("UPDATE `svList_account` SET `locked`= 1 WHERE nick = '$id'");
$address = $rowss[4];
require 'phpmailer/PHPMailerAutoload.php';
$mail = new PHPMailer;

$mail->SMTPDebug = 0; 
$mail->isSMTP();
##郵件伺服器位置
$mail->Host = 'smtp.gmail.com';
##郵件伺服器啟用加密
$mail->SMTPAuth = true;
##Email
$mail->Username = '';
##Email密碼
$mail->Password = '';
##郵件伺服器加密方式
$mail->SMTPSecure = 'ssl';
##郵件伺服器端口
$mail->Port = 465;

##郵件 Email/顯示名稱
$mail->setFrom('','');
$mail->addAddress($address);
$mail->addAddress($address);
$mail->addReplyTo('');

##與Email相同
$mail->addCC('');
$mail->addBCC('');

$mail->isHTML(true);

##郵件標題
$mail->Subject = '忘記密碼';

##郵件內文
$mail->Body    = '
<!DOCTYPE>
<html lang="zh_TW">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>伺服器列表帳戶狀態</title>
</head>
<body>
<div style="width: 100%; font-family: 微軟正黑體, Helvetica, sans-serif; font-size: 12px;">
您的帳戶：'.$rowss[1].'<br>
目前已經被<font color="red">強制鎖定</font>，若有任何問題，請至<a href="https://forum.gamer.com.tw/C.php?bsn=18673&snA=159343&subbsn=0" target="_blank">巴哈文章</a>提出問題詢問。<br>
若解鎖後又違規，將直接移除帳戶。
</div>
</body>
</html>';
$mail->AltBody = 'Test';
if($mail->send()){
$_SESSION['msg'] = 'accountlock';
}

if(!$mail->Send()){
echo "寄信發生錯誤：" . $mail->ErrorInfo;
}
else{ 
$_SESSION['msg'] = 'accountlock';
}

}

unset($_SESSION['name']);
unset($_SESSION['nick']);
unset($_SESSION['admin']);
unset($_SESSION['web']);
unset($_SESSION['msg']);
session_destroy();
?>
<meta http-equiv="refresh" content="0;url=index" />
</div>
</main>