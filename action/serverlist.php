<?php
include('sql.inc.php');
$rows = mysql_query("SELECT * FROM svList_list WHERE enable = 1");
$total = mysql_num_rows($rows);
$show = ceil($total/10);
if(empty($page))$page=1;
$start=10*($page-1);
@$page=$_GET["page"];
if(empty(@$page))@$page=1;
$start=10*(@$page-1);
$sql2 = "SELECT * FROM svList_list WHERE enable = 1 limit $start,10";
$result2 = mysql_query($sql2);
?>
<h2>已申請伺服器列表(<?php echo $page;?>/<?php echo $show;?>)<small>表格可移動</small></h2>
<div class="loading"><img src="_img/loading_apple.gif" style="height:45px;width:45px"></div>
<div id="svList">
<div class="table-responsive">
<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>查看</th>      
      <th>伺服器名稱</th>
      <th>連線位置</th>
      <th>版本</th>
      <th>類型</th>
      <th>註冊日期</th>
      <th>狀態</th>
    </tr>
  </thead>
  <tbody>
<?php
require 'action/refresh.php';
foreach( $json as $json )
  echo '
    <tr>
    ';?>
      <td><button class="btn btn-outline-primary" onclick="location.href='infosv?no=<?php echo $row2[0] ;?>'">查看</button></td>
    <?php echo'
      <td><b><center>'.$json->name.'</center></b></td>
      <td>'.$row2[2].$row2[3].'</td>
      <td>'.$row2[7].'</td>
      <td>'.$ty.'伺服</td>
      <td>'.$row2[10].'</td>
      <td>'.$svon.'</td>
    </tr>';
  ?>
  </tbody>
</table>
</div>
</div>
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