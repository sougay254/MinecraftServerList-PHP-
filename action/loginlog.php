<main class="mdl-layout__content mdl-color--grey-100">
<div class="mdl-dialog__content">
<?php
include('sql.inc.php');
if(@$_SESSION['admin'] == null){
$_SESSION['msg'] = "nopex";
?>
<script>document.location.href="../index";</script>
<?php }else{
$id = $_SESSION['id'];
@$mod = $_GET['mod'];
if(empty(@$mod))@$mod=0;
if ($mod == 0){
?>
<h3>您的登入紀錄</h3>
<?php }else{ ?>
<h3>所有使用者登入紀錄</h3>
<?php
}
//統計
if (@$mod == 1 AND @$_SESSION['admin'] == 1){
@$rows = mysql_query("SELECT * FROM svList_Loginlog  ORDER By No DESC");	
}else{
@$rows = mysql_query("SELECT * FROM svList_Loginlog WHERE account = '$id' ORDER By No DESC");	
}
@$total = mysql_num_rows($rows);
//頁數啟用
$show = ceil($total/30);
if(empty($page))$page=1;
$start=30*($page-1);
@$page=$_GET["page"];
if(empty(@$page))@$page=1;
$start=30*(@$page-1);
if (@$mod == 0 ){
@$sql = "SELECT * FROM svList_Loginlog WHERE account = '$id' ORDER By No DESC limit $start,30";
}elseif (@$mod == 1){
@$sql = "SELECT * FROM svList_Loginlog ORDER By No DESC limit $start,30";    
}
if ($_SESSION['admin'] == 1 AND $mod == 0){
?>
<button class="btn btn-outline-info" onclick="location.href='?mod=1&page=<?php echo $page;?>'">切換全部登入紀錄</button>
<?php }elseif ($_SESSION['admin'] == 1) {?>
<button class="btn btn-outline-success" onclick="location.href='?mod=0&page=<?php echo $page;?>'">切換自己登入紀錄</button>
<?php }?>
<hr>
<div class="table-responsive">
<table class="table">
  <thead>
    <tr>
        <th>#</th>
        <th>帳號</th>
        <th>暱稱</th>
        <th>登入IP</th>
        <th>登入時間</th>
        <th>狀態</th>
        <th>裝置</th>
    </tr>
<?php
if ($total == null) {
        echo "<div class='alert alert-danger'><font size='2'><span class='glyphicon glyphicon-exclamation-sign'></span> 無登入紀錄</font></div>";
    } else {
$result = mysql_query($sql);
while($row = mysql_fetch_row($result))
{
    ?>
<tr>
<td><?php echo $row[0];?></td>
<td><?php echo $row[1];?></td>
<td><?php echo $row[2];?></td>
<td><?php echo $row[3];?></td>
<td><?php echo $row[4];?></td>
<td><?php if ($row[5] == '登入成功'){echo '<span class="badge badge-success">登入成功</span>';}elseif($row[5] =='登入失敗'){echo '<span class="badge badge-danger">登入失敗</span>';}else{echo '<span class="badge badge-warning">'.$row[5].'</span>';};?></td>
<td><?php echo $row[6];?></td>
</tr>
<?php }
}?>
  </thead>
</table>
</div>
<!-- ##頁數功能## -->
<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
  <li class="page-item <?php if ($page == 1) {echo 'disabled';}?>" ><a class="page-link" href="?page=1&mod=<?php echo $mod;?>">«</a></li>
    <?php
    $pages = ceil($total/30);
    for( $i=1 ; $i<=$pages ; $i++ ) {
    if ( $page-4 < $i && $i < $page+5) {
    ?>
    <li class="page-item <?php if ($page == $i) { echo "active"; }?>"><a class="page-link" href="?page=<?php echo $i; ?>&mod=<?php echo $mod;?>"><?php echo $i; ?></a></li>
    <?php
    }
    } 
    if($show>=3){
        ?>
        <li class="page-item <?php if ($page == $show) {echo 'disabled';}?>"><a class="page-link" href="?page=<?php echo $show; ?>&mod=<?php echo $mod;?>">»</a></li>
        <?php
    }
    ?>
  </ul>
</nav>
<!-- ##頁數功能## -->
<?php } ?>
</div>
</main>