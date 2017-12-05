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
$user = @$_GET['user'];

@$search = @$_GET['search'];if ($search == null){$search = '0';}
@$v = $_GET['v'];if ($v == null){$v = '0';}
@$admin = $_GET['admin'];if ($admin == null){$admin = '0';}
@$pub = $_GET['pub'];if ($pub == null){$pub = '0';}
@$lock = $_GET['lock'];if ($lock == null){$lock = '0';}
//統計
if ($search == 0){
@$rows = mysql_query("SELECT * FROM `svList_account`");	
}else{
@$rows = mysql_query("SELECT * FROM `svList_account` WHERE `verification` = $v AND `admin` = $admin AND `brule` = $pub AND `locked` = $lock");
}
if ($user == null AND $search == 0){
@$rows = mysql_query("SELECT * FROM `svList_account`");
}elseif ($user != null AND $search == 0){
@$rows = mysql_query("SELECT * FROM `svList_account` WHERE `No` = '$user' OR `account` LIKE '%$user%' OR `nick` LIKE '%$user%' OR `email` LIKE '%$user%'");		
}
@$total = mysql_num_rows($rows);
//頁數啟用
$show = ceil($total/15);
if(empty($page))$page=1;
$start=15*($page-1);
@$page=$_GET["page"];
if(empty(@$page))@$page=1;
$start=15*(@$page-1);
if ($search == 0){
@$sql2 = "SELECT * FROM `svList_account` ORDER By No DESC limit $start,15";
}else{
@$sql2 = "SELECT * FROM `svList_account` WHERE `verification` = $v AND `admin` = $admin AND `brule` = $pub AND `locked` = $lock ORDER By No DESC limit $start,15";
}
	
if ($user == null AND $search == 0) {
@$sql2 = "SELECT * FROM `svList_account` ORDER By No DESC limit $start,15";
}elseif ($user != null AND $search == 0){
@$sql2 = "SELECT * FROM `svList_account` WHERE `No` = '$user' OR `account` LIKE '%$user%' OR `nick` LIKE '%$user%' OR `email` LIKE '%$user%' ORDER By No DESC limit $start,15";
}
$result2 = mysql_query($sql2);
?>
<div class="card">
<div class="card-body">
<form id="user" action="#" method="GET">
<div id="user" class="alert alert-danger" style="display: none"><b>查詢使用者</b></div>直接Enter送出查詢。
<input class="form-control" name="user" id="user" placeholder="查詢使用者" value="<?php echo @$_GET['user'];?>"/>
</form>
<h2>篩選功能 (單選功能請先清除一次該項目)</h2>
<button id="f_type" type="button" class="btn btn-danger" onclick="location.href='?page=<?php echo @$page;?>'">移除全部</button>
<p></p>
<div class="card">
<div class="row">
<div class="col-lg-3">
<div class="card-body">
(1) Email驗證<br>
<button id="f_mail" type="button" class="btn btn-success" onclick="location.href='?page=1&v=0<?php if ($admin != null){echo '&admin='.$admin;}if ($pub != null){echo '&pub='.$pub;}if ($lock != null){echo '&lock='.$lock;} ?>&search=1#account'">有</button>
<button id="f_mail" type="button" class="btn btn-danger" onclick="location.href='?page=1&v=1<?php if ($admin != null){echo '&admin='.$admin;}if ($pub != null){echo '&pub='.$pub;}if ($lock != null){echo '&lock='.$lock;} ?>&search=1#account'">無</button>
<button id="f_mail" type="button" class="btn btn-warning" onclick="location.href='?page=1#account'">清</button>
</div>
</div>
<p></p>
<div class="col-lg-3">
<div class="card-body">
(2) 管理者<br>
<button id="f_admin" type="button" class="btn btn-success" onclick="location.href='?page=1&admin=1<?php if ($v != null){echo '&v='.$v;}if ($pub != null){echo '&pub='.$pub;}if ($lock != null){echo '&lock='.$lock;} ?>&search=1#account'">有</button>
<button id="f_admin" type="button" class="btn btn-danger" onclick="location.href='?page=1&admin=0<?php if ($v != null){echo '&v='.$v;}if ($pub != null){echo '&pub='.$pub;}if ($lock != null){echo '&lock='.$lock;} ?>&search=1#account'">無</button>
<button id="f_admin" type="button" class="btn btn-warning" onclick="location.href='?page=1#account'">清</button>
</div>
</div>
<p></p>
<div class="col-lg-3">
<div class="card-body">
(3) 違規狀態<br>
<button id="f_pub" type="button" class="btn btn-success" onclick="location.href='?page=1<?php if ($v != null){echo '&v='.$v;}if ($admin != null){echo '&admin='.$admin;}if ($lock != null){echo '&lock='.$lock;} ?>&pub=1&search=1#account'">有</button>
<button id="f_pub" type="button" class="btn btn-danger" onclick="location.href='?page=1<?php if ($v != null){echo '&v='.$v;}if ($admin != null){echo '&admin='.$admin;}if ($lock != null){echo '&lock='.$lock;} ?>&pub=0&search=1#account'">無</button>
<button id="f_pub" type="button" class="btn btn-warning" onclick="location.href='?page=1#account'">清</button>
</div>
</div>
<p></p>
<div class="col-lg-3">
<div class="card-body">
(4) 鎖定狀態<br>
<button id="f_lock" type="button" class="btn btn-success" onclick="location.href='?page=1&lock=1<?php if ($v != null){echo '&v='.$v;}if ($admin != null){echo '&admin='.$admin;}if ($lock != null){echo '&pub='.$pub;} ?>&search=1#account'">有</button>
<button id="f_lock" type="button" class="btn btn-danger" onclick="location.href='?page=1&lock=0<?php if ($v != null){echo '&v='.$v;}if ($admin != null){echo '&admin='.$admin;}if ($lock != null){echo '&pub='.$pub;} ?>&search=1#account'">無</button>
<button id="f_lock" type="button" class="btn btn-warning" onclick="location.href='?page=1#account'">清</button>
</div>
</div>
</div>
</div>
</div>
</div>
<p></p>
<a name="account"></a>
<div class="table-responsive">
<table class="table table-striped table-bordered">
	  <thead>
		<tr>
		  <th>#</th>
		  <th>帳號</th>
		  <th>暱稱</th>
		  <th>EMail</th>
		  <th>是否驗證</th>
		  <th>管理員</th>
		  <th>忘記密碼</th>
		  <th>違規次數</th>
          <th>帳號狀態</th>
		  <th>忘記密碼</th>
		  <th>人工審核</th>
		  <th>編輯</th>
		  <th>移除</th>
		</tr>
	  </thead>
	  <tbody>
	  <?php
	if ($result2 != null) {
	while($row2 = mysql_fetch_row($result2))
	{
		if ($row2[5] == 0){
			$row2[5] = '已驗證';
		}else{
			$row2[5] = '未驗證';
		}
		if ($row2[6] == 0){
			$row2[6] = '否';
		}else{
			$row2[6] = '是';
		}
		if ($row2[7] == 0){
			$row2[7] = '無申請';
		}
		if ($row2[8] == 0){
			$row2[8] = '無違規';
		}else{
			$row2[8] = $row2[8].'次';
		}
        if ($row2[9] == 0){
            $row2[9] = '正常';
        }else{
            $row2[9] = '已鎖定';
        }
	  echo '
		<tr>
		  <td>'.$row2[0].'</td>
		  <td>'.$row2[1].'</td>
		  <td>'.$row2[3].'</td>
		  <td>'.$row2[4].'</td>
		  <td>'.$row2[5].'</td>
		  <td>'.$row2[6].'</td>
		  <td>'.$row2[7].'</td>
		  <td>'.$row2[8].'</td>
		  <td>'.$row2[9].'</td>
		  ';?>
		  <td><button type="button" class="btn btn-outline-danger " onclick="location.href='_sql/forgot_pw_admin.php?id=<?php echo $row2[1];?>&email=<?php echo $row2[4];?>'">傳送</button></td>
		  <td><button type="button" class="btn btn-outline-success" onclick="location.href='_sql/person_v.php?n=<?php echo $row2[0];?>'">驗證</button></td>
		  <td><button type="button" class="btn btn-outline-primary" onclick="location.href='?edit=true&n=<?php echo $row2[0];?>'">編輯</button></td>
		  <td><button class="btn btn-danger" onclick="delcomfirm<?php echo $row2[0];?>();">
			移除
		  </button></td>
		</tr>
		<script>
		function delcomfirm<?php echo $row2[0];?>(){
		if(confirm("請問你要移除《<?php echo $row2[1]?>》嗎？"))
		{
		document.location.href='_sql/delp?no=<?php echo $row2[0];?>';
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
</div>
<a name="editp"></a>
<?php if (@$_GET['edit'] == 'true'){
	include('editp.php');
}
?>
<!-- ##頁數功能## -->
<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center pagination-lg">
  <li class="page-item <?php if ($page == 1) {echo 'disabled';}?>" ><a class="page-link" href="?page=1<?php if ($user != null){echo '&user='.$user;}?><?php if ($search != null){echo '&search='.$search;}if ($v != null){echo '&v='.$v;}if ($admin != null){echo '&admin='.$admin;}if ($pub != null){echo '&pub='.$pub;}if ($lock != null){echo '&lock='.$lock;}?>">Prev</a></li>
  <li class="page-item <?php if ($page == 1) {echo 'disabled';}?>" ><a class="page-link" href="?page=<?php echo $page-1;?><?php if ($user != null){echo '&user='.$user;}?><?php if ($search != null){echo '&search='.$search;}if ($v != null){echo '&v='.$v;}if ($admin != null){echo '&admin='.$admin;}if ($pub != null){echo '&pub='.$pub;}if ($lock != null){echo '&lock='.$lock;}?>">&lt;</a></li>
<?php
$pages = ceil($total/15);
for( $i=1 ; $i<=$pages ; $i++ ) {
if ( $page-3 < $i && $i < $page+5) {
?>
<li class="page-item <?php if ($page == $i) { echo "active"; }?>"><a class="page-link" href="?page=<?php echo $i; ?><?php if ($user != null){echo '&user='.$user;}?><?php if ($search != null){echo '&search='.$search;}if ($v != null){echo '&v='.$v;}if ($admin != null){echo '&admin='.$admin;}if ($pub != null){echo '&pub='.$pub;}if ($lock != null){echo '&lock='.$lock;}?>"><?php echo $i; ?></a></li>
<?php
}
} 
if($show>=3){
    ?>
	<li class="page-item <?php if ($page == $show) {echo 'disabled';}?>" ><a class="page-link" href="?page=<?php echo $page+1;?><?php if ($user != null){echo '&user='.$user;}?><?php if ($search != null){echo '&search='.$search;}if ($v != null){echo '&v='.$v;}if ($admin != null){echo '&admin='.$admin;}if ($pub != null){echo '&pub='.$pub;}if ($lock != null){echo '&lock='.$lock;}?>">&gt;</a></li>
    <li class="page-item <?php if ($page == $show) {echo 'disabled';}?>"><a class="page-link" href="?page=<?php echo $show;?><?php if ($user != null){echo '&user='.$user;}?><?php if ($search != null){echo '&search='.$search;}if ($v != null){echo '&v='.$v;}if ($admin != null){echo '&admin='.$admin;}if ($pub != null){echo '&pub='.$pub;}if ($lock != null){echo '&lock='.$lock;}?>">Last</a></li>
    <?php
}
}
?>
  </ul>
</nav>
<!-- ##頁數功能## -->
</main>