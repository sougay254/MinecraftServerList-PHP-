<main class="mdl-layout__content mdl-color--grey-100">
<div class="mdl-dialog__content">
<button class="btn btn-outline-warning" onclick="history.back()">回上一頁</button>
<?php
$svno = $_GET['svno'];
include('sql.inc.php');
//伺服器資訊
$sql = "SELECT * FROM svList_list WHERE no = $svno;";
$result = mysql_query($sql);
$row = mysql_fetch_row($result);
//伺服器留言
$sqlc = "SELECT * FROM svList_comment WHERE server = $svno;";
$resultc = mysql_query($sqlc);
?>
<div class="table-responsive">
<table class="table table-hover">
<thead>
<th><?php echo $row[1];?></th>
</thead>
<tbody>
<tr>
<td>#</td>
<td>留言</td>
<td>發布者</td>
<td>時間</td>
<?php if (@$_SESSION['nick'] == $row[5] OR @$_SESSION['admin'] == 1){
echo '<td>移除</td>';
}?>
</tr>
<?php while($rowc = mysql_fetch_row($resultc)){
    if ($rowc[5]==1){
        $rowc[1] = '<font color="red"><i>此留言已被移除</i></font>';
    }?>
<tr>
<td><?php echo $rowc[0];?></td>
<td><?php echo $rowc[1];?></td>
<td><?php echo $rowc[2];?></td>
<td><?php echo $rowc[3];?></td>
<?php if (@$_SESSION['nick'] == $row[5] OR $_SESSION['admin'] == 1){
echo '<td><button class="btn btn-outline-danger" onclick="delcomfirm'.$rowc[0].'();">移除</button></td>';
}?>
<script>
function delcomfirm<?php echo $rowc[0];?>(){
if(confirm("請問你要移除《<?php echo $rowc[0];?>》嗎？")){
document.location.href='_sql/svm/delcom?no=<?php echo $rowc[0];?>&svno=<?php echo $_GET['svno'];?>';
}else{
return false;
}
}
</script>
</tr>
<?php }?>
</tbody>
</table>
	</div>
<?php include('ad.php'); ?>
</div>
</main>