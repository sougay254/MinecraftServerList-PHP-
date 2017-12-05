<?php
session_start();
include('sql.inc.php');
@$no = $_SESSION['cgno'];
@$name = $_POST['name'];
@$version = $_POST['version'];
@$website = $_POST['website'];
@$ip = $_POST['ip'];
@$port = $_POST['port'];
@$query = $_POST['query'];
@$type = $_POST['cgtype'];
@$enable = $_POST['enable'];
@$ipshow = $_POST['ipshow'];
if (@$_POST['ipbecause'] == null){
    $ipbecause = '';
}else{
    $ipbecause = $_POST['ipbecause'];
}
@$describtion = $_POST['info'];

$sql = "UPDATE `svList_list` SET `name`='$name',`ip`='$ip',`port`='$port',`query`='$query',`describtion`='$describtion',`version`='$version',`type`='$type',`website`='$website',`ipshow`='$ipshow',`ipbecause`='$ipbecause',`enable`='$enable' WHERE no = $no;";
if($result = mysql_query($sql))
{
$_SESSION['msg'] = "cgsvok";
header("Location: index"); 
exit;
}else{
$_SESSION['msg'] = "cgsvno";
header("Location: index"); 
exit;
}

