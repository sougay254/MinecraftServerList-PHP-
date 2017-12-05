<?php
session_start();
include('sql.inc.php');
@$no = $_GET['no'];
@$svno = $_GET['svno'];
@$owner = $_SESSION['id'];

$sql = "UPDATE `svList_comment` SET `locked`= 1 WHERE No = $no AND server = '$svno'";
if(mysql_query($sql))
{
$_SESSION['msg'] = "delcomok";
}else{
$_SESSION['msg'] = "delcomno";
}
header("Location: index"); 
exit;