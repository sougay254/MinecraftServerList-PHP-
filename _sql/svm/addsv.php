<?php
session_start();
include('sql.inc.php');
@$name = $_POST['name'];
@$ip = $_POST['ip'];
@$version = $_POST['version'];
@$website = $_POST['website'];
@$port = $_POST['port'];
@$type = $_POST['type'];
@$describtion = $_POST['info'];
@$enable = $_POST['enable'];
@$ipshow = $_POST['ipshow'];
if (@$_POST['ipbecause'] == null){
    $ipbecause = '';
}else{
    $ipbecause = $_POST['ipbecause'];
}
@$owner = $_SESSION['nick'];
@$date = date("Y/m/d H:i");

$sql = "INSERT INTO `svList_list` (`name`, `ip`, `port`, `owner`, `describtion`, `version`, `type`, `website`, `registered`, `enable`, `ipshow`, `ipbecause`) VALUES ('$name', '$ip', '$port', '$owner', '$describtion', '$version', '$type', '$website', '$date', '$enable', '$ipshow', '$ipbecause');";
if (mysql_query($sql)){
$row = @mysql_fetch_row($result);
$_SESSION['msg'] = "addsvok";
header("Location: index"); 
exit;
}else{
$_SESSION['msg'] = "addsvno";
header("Location: index"); 
exit;
}
