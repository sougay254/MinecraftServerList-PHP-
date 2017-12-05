<?php
session_start();
include('sql.inc.php');
$adminre = $_POST['adminre'];
$no = $_POST['no'];

if ($_SESSION['admin'] == 0 OR $_SESSION['admin'] == null){
$_SESSION['msg'] = 'nopex';
Header("Location: ../index");
exit;
}else{
$sql = "UPDATE `svList_op` SET `adminre` = '$adminre' WHERE No = $no;";
if(mysql_query($sql)){
$_SESSION['msg'] = 'adminreok';
}else{
$_SESSION['msg'] = 'adminreno';
}
Header("Location: ../reportlist");
exit;
}