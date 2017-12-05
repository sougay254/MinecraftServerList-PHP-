<?php
session_start();
include('sql.inc.php');
@$id = $_SESSION['id'];
@$opw = md5($_POST['oldpw']);
@$npw = md5($_POST['newpw']);

$result = mysql_query("SELECT * FROM svList_account WHERE account = '$id'");
$row = mysql_fetch_row($result);
if ($row[2] == $opw){
$sql = "UPDATE `svList_account` SET `password`='$npw' WHERE account = '$id';";
if(mysql_query($sql))
{
$_SESSION['msg'] = "cgpwok";
}else{
$_SESSION['msg'] = "cgpwno";
}
}else{
$_SESSION['msg'] = "cgpwerror_pw";
}
header("Location: ../player_db"); 
exit;

