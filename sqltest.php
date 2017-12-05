<?php
$db_server = "localhost:3306";
$db_name = "ohndejkc_svList";
$db_user = "ohnde_websv";
$db_passwd = "21135220aza";
if(!@mysql_connect($db_server, $db_user, $db_passwd))
        die("無法對資料庫連線");
mysql_query("SET NAMES utf8");
if(!@mysql_select_db($db_name))
        die("無法使用資料庫");
$sql = "SELECT * FROM svList_account WHERE account = 'haer0248'";
$result = mysql_query($sql);
$row = mysql_fetch_row($result);
echo $row[1];