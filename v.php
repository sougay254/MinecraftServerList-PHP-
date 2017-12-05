<?php
session_start();
include('sql.inc.php');
$v = $_GET['v'];
$id = $_GET['id'];
$sql = "SELECT * FROM svList_account WHERE account = '$id';";
$result = @mysql_query($sql);
$rows = @mysql_fetch_row($result);
if ($rows[1] == $id AND $rows[5] == $v){
$sql2 = "UPDATE `svList_account` SET `verification` = 0 WHERE account = '$id';";
mysql_query($sql2);
$_SESSION['msg'] = "vok";
header("Location: dashboard"); 
exit;
}else{
$_SESSION['msg'] = "verror";	
header("Location: dashboard"); 
exit;
}
include('_core/footer.php');