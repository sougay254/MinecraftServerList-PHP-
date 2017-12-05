<?php
session_start();
include('sql.inc.php');
@$no = $_GET['no'];

if ($_SESSION['admin'] != '1' OR $_SESSION['admin'] == null){
$_SESSION['msg'] == 'nopex';
header("Location: ../dashboard"); 
exit;
}else{
$sql = "DELETE FROM `svList_account` WHERE No = $no";
if(mysql_query($sql)){
$_SESSION['msg'] = "delpok";
}else{
$_SESSION['msg'] = "delpno";
}
header("Location: ../users"); 
exit;
}
