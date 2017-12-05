<main class="mdl-layout__content mdl-color--grey-100">
<div class="mdl-dialog__content">
<?php
include('sql.inc.php');
if(@$_SESSION['admin'] == null OR @$_SESSION['admin'] == 0){
$_SESSION['msg'] = "nopex";
?>
<script>document.location.href="../index";</script>
<?php
}else{
	$id = $_SESSION['nick'];
	//統計
	@$rows = mysql_query("SELECT * FROM svList_op");	
	@$total = mysql_num_rows($rows);
	//頁數啟用
	$show = ceil($total/10);
	if(empty($page))$page=1;
	$start=10*($page-1);
	@$page=$_GET["page"];
	if(empty(@$page))@$page=1;
	$start=10*(@$page-1);
	@$sql2 = "SELECT * FROM svList_op limit $start,10";
	$result2 = mysql_query($sql2);
		?>
<div class="table-responsive">
	<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
	  <thead>
		<tr>
		  <th>#</th>
		  <th>問題</th>
		  <th>回報者</th>
		  <th>回報IP</th>
		  <th>查看/回報</th>
		  <th>移除</th>
		</tr>
	  </thead>
	  <tbody>
	  <?php
	if ($result2 != null) {
	while($row2 = mysql_fetch_row($result2))
	{
	  echo '
		<tr>
		  <td>'.$row2[0].'</td>
		  <td>'.$row2[1].'</td>
		  <td>'.$row2[2].'</td>
		  <td>'.$row2[6].'</td>
		  ';?>
		  <td><button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored " onclick="location.href='?edit=true&no=<?php echo $row2[0];?>'">查看/回報</button></td>
		  <td><button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" onclick="delcomfirm<?php echo $row2[0];?>();">
			移除 </button>
		  </td>
		</tr>
		<script>
		function delcomfirm<?php echo $row2[0];?>(){
		if(confirm("請問你要移除《<?php echo $row2[0];?>》嗎？"))
		{
		document.location.href='_sql/delop?no=<?php echo $row2[0];?>';
		}
		else
		{
		return false;
		}
		}
		</script>
		<?php
	}
	}
	  ?>

	  </tbody>
	</table>
</div>
	<?php
	if (@$_GET['edit'] == 'true'){
	include('op/onlinereport.php');
	}
	?>
<!-- ##頁數功能## -->
<nav aria-label="Page navigation example">
  <ul class="pagination justify-content">
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
    <li class="page-item <?php if ($page == $show) {echo 'disabled'?>"><a class="page-link" href="?page=<?php echo $show;?>">»</a></li>
    <?php
}
}
?>
  </ul>
</nav>
<!-- ##頁數功能## -->
</div>
</main>
<?php }?>