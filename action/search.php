<main class="mdl-layout__content mdl-color--grey-100">
<div class="mdl-dialog__content">
<!-- #查詢功能#-->
<div class="row">
<div class="col-lg-6">
<form id="key" action="search" method="get">
<div class="input-group">
<span class="input-group-btn">
<button class="btn btn-secondary" type="button">名稱</button>
</span>
<input id="key" name="key" class="form-control" value="<?php echo @$_GET['key']?>" maxlength="32"/>
<button id="key" class="btn btn-success" type="submit">送出查詢</button>
</form>
</div>
</div>
</div>
</div>
<!-- #查詢功能#-->
<div class="mdl-dialog__content">
<?php
include('sql.inc.php');
@$key = @$_GET['key'];
//統計
@$rows = mysql_query("SELECT * FROM svList_list WHERE name LIKE '%$key%' AND enable = 1");	
@$total = mysql_num_rows($rows);
//頁數啟用
$show = ceil($total/10);
if(empty($page))$page=1;
$start=10*($page-1);
@$page=$_GET["page"];
if(empty(@$page))@$page=1;
$start=10*(@$page-1);
@$sql2 = "SELECT * FROM svList_list WHERE name LIKE '%$key%' AND enable = 1 limit $start,10";	
$result2 = mysql_query($sql2);
if (@$total == '0'){
echo '<div class="alert alert-warning">找不到資料，請重新輸入。</div>';
}else{
echo '
<div class="table-responsive">
<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>查看</th>      
      <th>伺服器名稱</th>
      <th>連線位置</th>
      <th>擁有者</th>
      <th>版本</th>
      <th>類型</th>
      <th>註冊日期</th>
      <th>註冊編號</th>
    </tr>
  </thead>
  <tbody>
';
while($rows = mysql_fetch_row($result2))
{
	$ty = $rows[8];
	if ($ty == 1){
		$ty = '插件';
	}elseif ($ty == 2){
		$ty = '模組';
	}elseif ($ty == 3){
		$ty = '官方';
	}elseif ($ty == 4){
		$ty = '綜合';
	}elseif ($ty == 5){
	   $ty = 'PE';
	}elseif ($ty == 6){
	   $ty = '小遊戲';
	}
	if ($rows[12] == 0){
	$rows[2] = $rows[13];
	}
    if ($rows[3] == '25565'){
        $rows[3] = null;
    }else{
        $rows[3] = ':'.$rows[3];
    } ?>
    <tr>
      <td><button class="btn btn-outline-primary" onclick="location.href='infosv?no=<?php echo $rows[0] ;?>'">查看</button></td>
    <?php echo'
      <td><b><center>'.$rows[1].'</center></b></td>
      <td>'.$rows[2].$rows[3].'</td>
      <td>'.$rows[5].'</td>
      <td>'.$rows[7].'</td>
      <td>'.$ty.'伺服</td>
      <td>'.$rows[10].'</td>
      <td>'.$rows[0].'</td>
	  ';
}
	  ?>
    </tr>
  </tbody>
</table>
</div>
<!-- ##頁數功能## -->
<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
  <li class="page-item <?php if ($page == 1) {echo 'disabled';}?>" ><a class="page-link" href="?page=1">«</a></li>
<?php
$pages = ceil($total/10);
for( $i=1 ; $i<=$pages ; $i++ ) {
if ( $page-3 < $i && $i < $page+5) {
?>
<li class="page-item <?php if ($page == $i) { echo "active"; }?>"><a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
<?php
}
} 
if($show>=3){
    ?>
    <li class="page-item <?php if ($page == $show) { echo 'disabled'; }?> "><a class="page-link" href="?page=<?php echo $show;?>">»</a></li>
    <?php
}
}
?>
  </ul>
</nav>
</div>
<?php include('ad.php'); ?>
</div>
</main>