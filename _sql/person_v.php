<?php
session_start();
if ($_SESSION['admin'] == 1){
include('sql.inc.php');
$n = $_GET['n'];

$sql = "SELECT * FROM svList_account WHERE No = '$n';";

$result = @mysql_query($sql);
$rows = @mysql_fetch_row($result);
$sql2 = "UPDATE `svList_account` SET `verification` = 0 WHERE No = '$n';";
mysql_query($sql2);
$_SESSION['msg'] = "vadminok";
header("Location: ../users"); 
exit;
}
include('_core/footer.php');