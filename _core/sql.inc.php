<?php
## 資料庫位置
$db_server = "localhost";

## 資料庫
$db_name = "dashboard";

## 資料庫帳號
$db_user = "root";

## 資料庫密碼
$db_passwd = "";
if(!@mysql_connect($db_server, $db_user, $db_passwd))
        die("無法對資料庫連線");
mysql_query("SET NAMES utf8");
if(!@mysql_select_db($db_name))
        die("無法使用資料庫");
?> 