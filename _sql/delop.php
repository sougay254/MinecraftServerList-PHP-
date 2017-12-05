<?php
session_start();
include('sql.inc.php');
@$no = $_GET['no'];

if ($_SESSION['admin'] != '1' OR $_SESSION['admin'] == null){
$_SESSION['msg'] == 'nopex';
header("Location: ../dashboard"); 
exit;
}else{
$sql = "DELETE FROM `svList_op` WHERE No = $no";
if(mysql_query($sql)){
$_SESSION['msg'] = "delopok";
}else{
$_SESSION['msg'] = "delopno";
}
header("Location: ../reportlist"); 
exit;
}
