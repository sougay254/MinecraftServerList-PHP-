<?php
session_start();
include('sql.inc.php');
@$name = $_SESSION['nick'];
@$contect = $_POST['contect'];
@$date = date("Y/m/d H:i");
if(!empty($_SERVER['HTTP_CLIENT_IP'])){
   $ip = $_SERVER['HTTP_CLIENT_IP'];
}else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
   $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
}else{
   $ip= $_SERVER['REMOTE_ADDR'];
}

$sql = "INSERT INTO `svList_op` (`reporter`, `contect`, `date`, `ip`) VALUES ('$name', '$contect', '$date', '$ip');";
if (mysql_query($sql)){
$_SESSION['msg'] = "addopok";
}else{
$_SESSION['msg'] = "addopno";
}
header("Location: index"); 
exit;
