<?php
session_start();
include('sql.inc.php');
@$text = $_POST['text'];
@$no = $_POST['no'];
@$nick = $_SESSION['nick'];
@$date = date("Y/m/d H:i");

$sql = "INSERT INTO `svList_comment` (`text`, `nick`, `date`, `server`) VALUES ('$text', '$nick', '$date', '$no');";
if (mysql_query($sql)){
$_SESSION['msg'] = "addcomok";
}else{
$_SESSION['msg'] = "addcomno";
}
header("Location: index"); 
exit;
