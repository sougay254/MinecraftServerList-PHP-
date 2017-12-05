<?php
session_start();
include('sql.inc.php');
if ($_SESSION['admin'] == null OR $_SESSION['admin'] == 0){
$_SESSION['msg'] = "nopex";
header("Location: index"); 
exit;
}else{
@$no = $_POST['no'];
@$account = $_POST['account'];
@$nick = $_POST['nick'];
@$email = $_POST['email'];
@$verification = $_POST['verification'];
@$admin = $_POST['admin'];
@$vpw = $_POST['vpw'];
@$brule = $_POST['brule'];
@$locked = $_POST['locked'];

$sql = "UPDATE `svList_account` SET `account`='$account',`nick`='$nick',`email`='$email',`verification`='$verification',`admin`='$admin',`vpw`='$vpw',`brule`='$brule',`locked`='$locked' WHERE no = $no;";
if($result = mysql_query($sql))
{
$_SESSION['msg'] = "cgpok";
}else{
$_SESSION['msg'] = "cgpno";
}
header("Location: ../users"); 
exit;
}