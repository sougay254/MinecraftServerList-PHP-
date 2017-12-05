<?php
session_start();
if ($_SESSION['admin'] == null){
    echo '<div class="alert alert-danger">您無此權限觀看此頁面</div>';
}else{
include('sql.inc.php');
$no =  @$_POST['no'];
$text = @$_POST['text'];

if (@$text != null) 
{
        $sql = "UPDATE svList_bc SET contect = '$text' WHERE No = $no;";
        if(mysql_query($sql))
        {
            $_SESSION['msg'] = 'cgbcok';
        }
}else{
            $_SESSION['msg'] = 'cgbcno';
        }
}
?>
<script>document.location.href="../index";</script>