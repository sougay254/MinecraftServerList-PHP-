<?php include('sql.inc.php'); ?>
<main class="mdl-layout__content mdl-color--grey-100">
<div class="mdl-dialog__content">
<style>
hide {
  display : inline-block;
  overflow : hidden;
  text-overflow : ellipsis;
  white-space : nowrap;
  height : 20px;
  width : 100px;
}
</style>
<?php
if(@$_SESSION['admin'] == null OR @$_SESSION['admin'] == 0){
$_SESSION['msg'] = "nopex";
}else{
$rows = mysql_query("SELECT * FROM svList_bc");
@$total = mysql_num_rows($rows);
//頁數啟用
$show = ceil($total/10);
if(empty($page))$page=1;
$start=10*($page-1);
@$page=$_GET["page"];
if(empty(@$page))@$page=1;
$start=10*(@$page-1);
$sql = "SELECT * FROM svList_bc limit $start,10 ";
?>
<h2>公告控制系統</h2><div style="text-align:right;height:20"><button class="btn btn-success" onclick="location.href='?addbcenable=true'">新增</button></div><br>
<div class="table-responsive">
<table class="table table-bordered">
<tr>
<td>編號</td>
<td>內容</td>
<td>編輯</td>
<td>移除</td>
</tr>
<?php
if ($total == null) {
        echo "<div class='alert alert-danger'><font size='4'><span class='glyphicon glyphicon-exclamation-sign'></span> 資料庫中無公告</font></div>";
    } else {
$result = mysql_query($sql);
while($row = mysql_fetch_row($result))
{
    ?>
<tr>
<td><?php echo $row[0];?></td>
<td><hide><?php echo $row[1];?></hide></td>
<td><button class="btn btn-info" onclick="location.href='?cgbcenable=true&bcno=<?php echo $row[0];?>'">編輯</button></td>
<td><button class="btn btn-danger" onclick="location.href='./_sql/bc/del_bc.php?delnb=<?php echo $row[0];?>'">移除</button></td>
</tr>
<?php }
}?>
</table>
</div>
<?php
@$cgbcenable = $_GET['cgbcenable'];
@$bcno = $_GET['bcno'];
if ($cgbcenable == true) {
$sql = "SELECT * FROM svList_bc WHERE No = $bcno";
$result = mysql_query($sql);
$row = mysql_fetch_row($result)
?>
<div class="table-responsive">
<form name="bc1" method="post" action="./_sql/bc/cg_bc.php">
<div class="jumbotron">
	<font size='5'>固定編號：</font><br><font size="3" color="red">無法修改</font><input type="text" name="no" class="form-control" value="<?php echo $row[0];?>" readonly /><br><br>
	<font size='5'>公告內容：</font><br><font size="3">可使用Html標籤</font><textarea name="text" class="form-control" value=""><?php echo $row[1];?></textarea><br><br>
</div>
<br>
<div class="btn-group">
	<input type="submit" class="btn btn-primary" value="確定" />
	<input type="reset" class="btn btn-primary" value="清除重填" />
</div>
</form>
</div>
<?php }?>
<?php
@$addbcenable = $_GET['addbcenable'];
if ($addbcenable == true) {
?>
<div class="table-responsive">
<form name="bc2" method="post" action="./_sql/bc/add_bc.php">
<div class="jumbotron">
	<font size='5'>公告內容：</font><br><font size="3">可使用Html標籤</font><textarea name="text" class="form-control" /></textarea><br><br>
</div>
<br>
<div class="btn-group">
	<input type="submit" class="btn btn-primary" value="確定" />
	<input type="reset" class="btn btn-primary" value="清除重填" />
</div>
</form>
</div>
<?php }?>
<!-- ##頁數功能## -->
<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
  <li class="page-item <?php if ($page == 1) {echo 'disabled';}?>" ><a class="page-link" href="?page=1">«</a></li>
    <?php
    $pages = ceil($total/10);
    for( $i=1 ; $i<=$pages ; $i++ ) {
    if ( $page-4 < $i && $i < $page+5) {
    ?>
    <li class="page-item <?php if ($page == $i) { echo "active"; }?>"><a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
    <?php
    }
    } 
    if($show>=3){
        ?>
        <li class="page-item <?php if ($page == $show) {echo 'disabled';}?>"><a class="page-link" href="?page=<?php echo $show; ?>">»</a></li>
        <?php
    }
    ?>
  </ul>
</nav>
<!-- ##頁數功能## -->
<?php }?>
</div>
</main>