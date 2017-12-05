<main class="mdl-layout__content mdl-color--grey-100">
<div class="mdl-dialog__content">
<?php
include('sql.inc.php');
if(@$_SESSION['admin'] == null){
    include('_core/nologin.php');
    if (@$_GET['c']!=null){echo '<div class="jumbotron">';}
        if(@$_GET['c']=='login'){
        include('_core/login.php');
        }elseif(@$_GET['c']=='register'){
        include('_core/register.php');
        }elseif(@$_GET['c']=='mail_confirm'){
        include('_core/mail_confirm.php');
        }elseif(@$_GET['c']=='forgot_pw'){
        include('_core/forgot_pw.php');
        }elseif(@$_GET['c']=='chang_pw'){
        include('_core/chang_pw.php');
        }
   if (@$_GET['c']!=null){echo '</div>';}
}else{
    @$type = $_GET['type'];
    @$opened = $_GET['opened'];
    if ($opened == null){
        $opened = '1';
    }else{
        $opened = $_GET['opened'];
    }
	$id = $_SESSION['nick'];
    $acc = "SELECT * FROM svList_account WHERE nick = '$id'";
    $result1 = mysql_query($acc);
    $rowss = mysql_fetch_row($result1);
    if ($rowss[8] == 0){
        echo '<div class="alert alert-success">帳戶狀態良好！沒有違規紀錄！</div>';
    }elseif ($rowss[8] != 0 AND $rowss[8] != 10){
        echo '<div class="alert alert-warning">帳戶警告狀態！已經違反了'.$rowss[8].'次</div>';
    }elseif ($rowss[8] == 10){
        echo '<div class="alert alert-danger">帳戶鎖定。將強制登出。</div>';
        echo '<meta http-equiv="refresh" content="2;url=../logout" />';
    }
	//統計
	if ($_SESSION['admin'] == 1){
        if ($type != null){
            @$rows = mysql_query("SELECT * FROM svList_list WHERE type = '$type' AND enable = '$opened'");
        }else{
            @$rows = mysql_query("SELECT * FROM svList_list WHERE enable = '$opened'");
        }
	}else{
        if ($type != null){
            @$rows = mysql_query("SELECT * FROM svList_list WHERE owner = '$id' AND type = '$type' AND enable = '$opened'");	
        }else{
            @$rows = mysql_query("SELECT * FROM svList_list WHERE owner = '$id'");	
        }
	}
	@$total = mysql_num_rows($rows);
	//頁數啟用
	$show = ceil($total/10);
	if(empty($page))$page=1;
	$start=10*($page-1);
	@$page=$_GET["page"];
	if(empty(@$page))@$page=1;
	$start=10*(@$page-1);
	if ($_SESSION['admin'] == 1){
        if ($type != null){
            @$sql2 = "SELECT * FROM svList_list WHERE type = '$type' AND enable = '$opened' limit $start,10";
        }else{
            @$sql2 = "SELECT * FROM svList_list WHERE enable = '$opened' limit $start,10";
        }
	}else{
        if ($type != null){
            @$sql2 = "SELECT * FROM svList_list WHERE owner = '$id' AND type = '$type' AND enable = '$opened' limit $start,10";	
        }else{
            @$sql2 = "SELECT * FROM svList_list WHERE owner = '$id' limit $start,10";	
        }
	}
	$result2 = mysql_query($sql2);
		?>
		<div class="demo-card-wide mdl-shadow--2dp">
		<h3 class="mdl-card__title-text">系統公告：</h3>
		<?php
		$sql6 = 'SELECT * FROM `svList_bc` limit 5';
		$result6 = mysql_query($sql6);
		?>
			<ul>
		<?php
		while (@$rowbc = mysql_fetch_row(@$result6)){
		if ($rowbc[0] == null){
		echo '無。';
		}else{
		?>
		<li><?php echo @$rowbc[1];?></li>
		<?php }}?>
		</ul>
		</div>
		<p></p>
		<div class="demo-card-wide mdl-shadow--2dp">
		  <div class="mdl-card__title">
			<h3 class="mdl-card__title-text">
			<?php if ($_SESSION['admin'] == '1'){
					echo '管理者,';
				}else{
					echo '玩家,';
					}
			echo $_SESSION['nick'];?> 歡迎來到創世神列表網站。</h3>
		  </div>
		  <div class="mdl-card__supporting-text">
			<?php
			if ($_SESSION['admin'] == '1'){
			echo '這邊可以看到所有玩家製作的創世神伺服器列表，請注意，移除為「直接移除」請不要手殘。';
			}else{
			echo '這邊可以看到你所擁有的伺服器，可進行管理、設定、移除、查看。';
			}
			?>
			<br>
			即將新增功能：<b>帳號保護功能</b>。
		  </div>
		  <div class="mdl-card__actions mdl-card--border">
		  <?php if ($total == '0'){echo '還沒有伺服器？';}else{echo '擁有的伺服器 '.$total.' 個。';}?>
			<button type="button" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" onclick="location.href='?addsv=true#addsv'">新增伺服器</button>
		  </div>
		</div>
<p></p>
<?php if ($_SESSION['admin'] == '1'){?>
<div class="card">
  <div class="card-body">
  <h2>篩選功能</h2>
  <button id="f_type" type="button" class="btn btn-danger" onclick="location.href='?page=<?php echo @$page;?>'">移除全部</button>
<div class="card">
  <div class="card-body">
  (1) 伺服器類型<br>
  <button id="f_type" type="button" class="btn btn-success" onclick="location.href='?page=1&type=1&opened=<?php echo @$opened;?>'">插件</button>
  <button id="f_type" type="button" class="btn btn-success" onclick="location.href='?page=1&type=2&opened=<?php echo @$opened;?>'">模組</button>
  <button id="f_type" type="button" class="btn btn-success" onclick="location.href='?page=1&type=3&opened=<?php echo @$opened;?>'">官方</button>
  <button id="f_type" type="button" class="btn btn-success" onclick="location.href='?page=1&type=4&opened=<?php echo @$opened;?>'">綜合</button>
  <button id="f_type" type="button" class="btn btn-success" onclick="location.href='?page=1&type=5&opened=<?php echo @$opened;?>'">PE</button>
  <button id="f_type" type="button" class="btn btn-success" onclick="location.href='?page=1&type=6&opened=<?php echo @$opened;?>'">小遊戲</button>
  </div>
</div>
<p></p>
<div class="card">
  <div class="card-body">
  (2) 伺服器狀態<br>
  <button id="f_enable" type="button" class="btn btn-success" onclick="location.href='?page=1<?php if ($type != null){echo '&type='.$type;}?>&opened=1'">顯示</button>
  <button id="f_enable" type="button" class="btn btn-success" onclick="location.href='?page=1<?php if ($type != null){echo '&type='.$type;}?>&opened=0'">隱藏</button>
</div>
</div>
</div>
</div>
<?php } ?>
<br>
<a name="list"></a>
<div class="table-responsive">
	<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
	  <thead>
		<tr>
		  <th>#</th>
		  <th>伺服器名稱</th>
		  <th>伺服器IP</th>
		  <th>伺服器Port</th>
		  <th>伺服器Query</th>
		  <th>伺服器擁有者</th>
		  <th>伺服器版本</th>
		  <th>伺服器類型</th>
		  <th>伺服器註冊日期</th>
		  <th>是否啟用</th>
		  <th>編輯</th>
		  <th>移除</th>
		</tr>
	  </thead>
	  <tbody>
	  <?php
	if ($result2 != null) {
	while($row2 = mysql_fetch_row($result2))
	{
		$ty = $row2[8];
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
		$e = $row2[11];
		if ($e == 1){
			$e = '顯示';
		}else{
			$e = '隱藏';
		}
	  echo '
		<tr>
		  <td>'.$row2[0].'</td>
		  <td>'.$row2[1].'</td>
		  <td>'.$row2[2].'</td>
		  <td>'.$row2[3].'</td>
		  <td>'.$row2[4].'</td>
		  <td>'.$row2[5].'</td>
		  <td>'.$row2[7].'</td>
		  <td>'.$ty.'伺服</td>
		  <td>'.$row2[10].'</td>
		  <td>'.$e.'</td>
		  ';?>
		  <td><button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored " onclick="location.href='?edit=true&n=<?php echo $row2[0];?>&page=<?php echo $page;?>#editsv'">編輯</button>
		  </td>
		  <td>
			  <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" onclick="delcomfirm<?php echo $row2[0]; ?>();">
			移除
		  </button>
		  </td>
		</tr>
<script>
function delcomfirm<?php echo $row2[0]; ?>(){
if(confirm("請問你要移除《<?php echo $row2[1]?>》嗎？"))
{
document.location.href='_sql/svm/delsv?no=<?php echo $row2[0];?>';
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
<a name="addsv"></a>
<?php if (@$_GET['addsv'] == 'true'){
	include('addsv.php');
}?>
<a name="editsv"></a>
<?php if (@$_GET['edit'] == 'true'){
	include('editsv2.php');
}
?>
<p></p>
<!-- ##頁數功能## -->
<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center pagination-lg">
  <li class="page-item <?php if ($page == 1) {echo 'disabled';}?>" ><a class="page-link" href="?page=1<?php if ($type != null){echo '&type='.$type;} if ($opened != null){echo '&opened='.$opened;}?>#list">Prev</a></li>
    <li class="page-item <?php if ($page == 1) {echo 'disabled';}?>" ><a class="page-link" href="?page=<?php echo $page-1;?><?php if ($type != null){echo '&type='.$type;} if ($opened != null){echo '&opened='.$opened;}?>#list">&lt;</a></li>
    <?php
    $pages = ceil($total/10);
    for( $i=1 ; $i<=$pages ; $i++ ) {
    if ( $page-3 < $i && $i < $page+5) {
    ?>
    <li class="page-item <?php if ($page == $i) { echo "active"; }?>"><a class="page-link" href="?page=<?php echo $i; ?><?php if ($type != null){echo '&type='.$type;} if ($opened != null){echo '&opened='.$opened;}?>#list"><?php echo $i; ?></a></li>
    <?php
    }
    } 
    if($show>=3){
        ?>
	    <li class="page-item <?php if ($page == $show) {echo 'disabled';}?>" ><a class="page-link" href="?page=<?php echo $page+1;?><?php if ($type != null){echo '&type='.$type;} if ($opened != null){echo '&opened='.$opened;}?>#list">&gt;</a></li>
        <li class="page-item <?php if ($page == $show) {echo 'disabled';}?>"><a class="page-link" href="?page=<?php echo $show; ?><?php if ($type != null){echo '&type='.$type;} if ($opened != null){echo '&opened='.$opened;}?>#list">Last</a></li>
        <?php
    }
}
    ?>
  </ul>
</nav>
<!-- ##頁數功能## -->
</div>
</main>