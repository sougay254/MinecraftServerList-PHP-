<?php
session_start();
 if ($_SESSION['admin'] == null){
    echo '<div class="alert alert-danger">您無此權限觀看此頁面</div>';
}else{
include('sql.inc.php');
$delbc = $_GET['delnb'];

if (@$delbc != null) 
{
        $sql = "DELETE FROM svList_bc WHERE No = $delbc";
        if(mysql_query($sql))
        {
            $_SESSION['msg'] = 'delbcok';
        }
}
else
        {
            $_SESSION['msg'] = 'delbcno';
        }
}
?>
<script>document.location.href="../index";</script>