<?php
session_start();
if ($_SESSION['admin'] == null){
    echo '<div class="alert alert-danger">您無此權限觀看此頁面</div>';
}else{
include('sql.inc.php');
$text = @$_POST['text'];

if ($text != null){
        $sql = "insert into svList_bc (contect) values ('$text')";
        if(mysql_query($sql)){
            $_SESSION['msg'] = 'addbcok';
        }
}else{
            $_SESSION['msg'] = 'addbcno';
        }
}
?>
<script>document.location.href="../index";</script>