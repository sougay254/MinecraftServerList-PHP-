<style>
.minecraft {
	color: #AAAAAA;
	display: inline-block;
	font-family: Minecraft Regular,sans-serif;
	font-size: 115%;
	letter-spacing: 0px;
	padding: 0px;
	white-space: 0px;
	height: full;
}
</style>
<?php
include('sql.inc.php');
@$no = $_GET['no'];
@$sql = "SELECT * FROM svList_list WHERE no = $no AND enable = 1";
@$result = mysql_query($sql);
@$row = mysql_fetch_row($result);
@$t = mysql_num_rows($row);
if ($row == null Or $t == '0'){
$_SESSION['msg'] = 'noserver';
?>
<script>document.location.href="../index";</script>
<?php
}else{
$ty = $row[8];
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
/*if (@$row[2] == 'game.amsserver.xyz'){
	@$row[2] = 'amsserver.servegame.com';
	@$ip = 'game.amsserver.xyz';
	@$oip = 'game.amsserver.xyz';
}elseif (@$row[2] == 'play.dreammemory.net'){
	@$row[2] = 'dreammemorymc.hopto.org';
	@$ip = 'play.dreammemory.net';
	@$oip = 'play.dreammemory.net';
}else{
   @$ip = $row[2];
   @$oip = $row[2];
}*/
if ($row[12] == 0){
    $ip = $row[13];
}
$serverip = $row[2];
$serverport = $row[3];
if ($serverport == '25565'){
$status = json_decode(file_get_contents('https://api.mcsrvstat.us/1/' . $serverip));
}else{
$status = json_decode(file_get_contents('https://api.mcsrvstat.us/1/' . $serverip . ':' . $serverport));
}
$offline = @$status->offline;
if($offline == 'true'){
	$svon = '<font color="red">無法連線到伺服器</font>';
	$see = 'false';
}else{$svon = '<font color="green">盡情遊玩!</font>';
	$maxplayers = $status->players->max;
	$currentplayers = $status->players->online;
	@$software = $status->software;
	$motd = $status->motd->html;
	$icon = $status->icon;
	$see = 'true';
}
//$json = file_get_contents('https://mcapi.us/server/status?ip=' . $serverip . '&port=' . $serverport);
/*$data = json_decode($json,true);					
$online = $data['online'];
$motd = $data['motd']; 
$error = $data['error'];*/
?>
<main class="mdl-layout__content mdl-color--grey-100">
<div class="mdl-dialog__content">
<button class="btn btn-outline-warning" onclick="history.back()">回上一頁</button>
<?php if ($row[5] == @$_SESSION['nick'] OR @$_SESSION['admin'] == '1'){?>
<button class="btn btn-outline-info" onclick="location.href='dashboard?edit=true&n=<?php echo $row[0];?>#editsv'">編輯伺服器</button>
<?php }?>
<hr>
<?php if (@$_SESSION['admin'] == null){
echo '
<div id="error" class="alert alert-info">
登入後才可發布留言。 <a href="dashboard?c=login">點我登入</a>
</div>
';
}else{?>
<!-- #玩家留言功能# -->
	<div id="error" class="alert alert-warning" style="display: none">
	送出失敗 » 請填寫留言
	</div>
	<form id="addcom" action="_sql/svm/addcom.php" method="post">
	<div class="input-group">
	<input name="no" type="hidden" value="<?php echo $row[0];?>" />
	<input id="text" name="text" type="text" class="form-control" placeholder="請輸入留言" />
	<button type="button" class="btn btn-outline-success" onclick="check();">送出留言</button>
	<script>
	function check(){
	var text = document.getElementById('text');
	var error = document.getElementById('error');
	if (text.value == ''){
	error.style.display = "block";
	}else{
	if(confirm("請再次確認要送出留言。\n送出後將遵守網路的基本規範。\n若違反將同意進行懲處。")){
	document.getElementById('addcom').submit();
	}else{
	return false;
	}
	}
	}
	</script>
	</div>
	</form>
<!-- #玩家留言功能#End -->
<?php } ?>
<p></p>
<div class="panel panel-default">
<div class="panel-body">
<div class="btn-group" role="group">
<?php if (@$icon != null){?>
<img src="<?php echo $icon;?>" style="height:64px;width:64px">
<?php }?>
<div class="minecraft" style="background-image:url('_img/minecraft.png');">
<?php 
$msg = "Can't connect to server.";
if ($see!='false'){
echo $row[1].'<br>';
echo '<center>';
foreach($motd as $motd) {
	echo $motd.'<br>';
}
echo '</center>';
}else{
	echo '<center><font color="red">'.$msg.'<br>無法連線到伺服器</font></center>';
}
?>
</div>
</div>

<br>
<br>
<div class="row">
<div class="col-md-6">
<h3><b>【介紹】</b></h3>
<?php echo $row[6];?>
</div>
<div class="col-md-6">
<h3><b>【玩家留言】</b><a href="../svcomment?svno=<?php echo $row[0]; ?>">更多</a></h3>
<div class="table-responsive">
<table class="table table-hover">
<thead>
</thead>
<tbody>
<tr>
<td>#</td>
<td>留言</td>
<td>發布者</td>
</tr>
<?php
$sqlss = "SELECT * FROM svList_comment WHERE server = '$row[0]' AND locked = 0 ORDER By No DESC limit 5";
$resultss = mysql_query($sqlss);
$all = mysql_num_rows($resultss);
while ($rowss = mysql_fetch_row($resultss)) {
if ($all == '0') {
	$rowss[0] = '此伺服器無留言';
	$rowss[1] = '';
	$rowss[2] = '';
}else{
	if ($rowss[5] == '1') {
	$rowss[1] = '<font color="red"><i>此留言已被移除</i></font>';
	}
}?>
<tr>
<td><?php echo $rowss[0];?></td>
<td><?php echo $rowss[1];?></td>
<td><?php echo $rowss[2];?></td>
</tr>
<?php } ?>
</tbody>
</table>
</div>
</div>
</div>
<?php }?>
</div>
</div>
<div class="table-responsive">
<table class="table">
<tbody>
<tr>
<td style="width: 40%;"><b>【註冊編號】</b></td>
<td><?php echo $row[0];?></td>
</tr>
<tr>
<td><b>【伺服狀態】</b></td>
<td><?php echo $svon;?>
</tr>
<tr>
<td><b>【連線位置(點擊可複製)】</b></td>
<td>
<b>
<div class="form-group">
<?php if ($row[12]=='1'){?>
<input id="copy" class="mdl-textfield__input" value="<?php echo $row[2];?><?php if ($row[3] != '25565'){echo ':'.$row[3];};?>" readonly style="width:100%" onClick="copyUrl2()"/>
<?php }else{
echo $row[13];    
}?>
</div>
</b> 
</td>
</tr>
<tr>
<td><b>【伺服分類】</b></td>
<td><?php echo $ty;?>伺服器</td>
</tr>
<tr>
<td><b>【擁有者】</b></td>
<td><?php echo $row[5];?></td>
</tr>
<tr>
<td><b>【相關網站】</b></td>
<td><a target="_blank" href="<?php echo $row[9];?>"><?php echo $row[9];?></a></td>
</tr>
<tr>
<td><b>【線上/最大玩家】</b></td>
<td><?php if ($see!='false'){echo $currentplayers.'/'.$maxplayers; if ($currentplayers==$maxplayers){echo '<font color="red">(已滿)</font>';}}else{echo '<font color="red">無法連線到伺服器</font>';};?></td>
</tr>
<tr>
<td><b>【伺服版本】</b></td>
<td><?php echo $row[7];?></td>
</tr>
<tr>
<td><b>【伺服軟體】</b></td>
<td><?php if ($see!='false'){echo $software;}else{echo '<font color="red">無法連線到伺服器</font>';}?></td>
</tr>
<tr>
<td><b>【註冊日期】</b></td>
<td><?php echo $row[10];?></td>
</tr>
</tbody>
</table>
</div>
</div>
<script type="text/javascript">  
function copyUrl2(){  
var Url2=document.getElementById("copy");
if (Url2.value !== "貼上到伺服器連線位置吧") {
Url2.select();
document.execCommand("Copy");
Url2.value = "貼上到伺服器連線位置吧";
alert("複製成功!");  
}else{
alert("已複製過");
}
}  
</script>
</div>
</main>