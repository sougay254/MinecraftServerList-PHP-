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
<main class="mdl-layout__content mdl-color--grey-100">
<div class="mdl-dialog__content">
<div class="alert alert-success"><b>此處可即時查詢本網站以外伺服器資訊。</b></div>
<form id="query" action="#" method="GET">
<div id="notice" class="alert alert-danger" style="display: none"><b>請輸入IP位置查詢。</b></div>直接Enter送出查詢。
<input class="form-control" name="ip" id="ip" placeholder="請輸入伺服器IP" value="<?php echo @$_GET['ip'];?>"/>
</form>
<?php
include('sql.inc.php');
@$ip = $_GET['ip'];
if ($ip != null){
$serverip = $ip;
$status = json_decode(file_get_contents('https://api.mcsrvstat.us/1/' . $serverip));
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
@$ip = $_GET['ip'];
@$sql = "SELECT * FROM svList_list WHERE ip = '$ip' AND enable = 1";
@$result = mysql_query($sql);
@$row = mysql_fetch_row($result);
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
?>
查詢 <b><?php echo $ip;?></b> 伺服器資訊<br>
<div class="btn-group" role="group">
<?php if (@$icon != null){?>
<img src="<?php echo $icon;?>" style="height:64px;width:64px">
<?php }?>
<div class="minecraft" style="background-image:url('_img/minecraft.png');">
<?php 
$msg = "Can't connect to server.";
if ($see!='false'){
echo $ip.'<br>';
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


</div>
<div class="table-responsive">
<table class="table">
<tbody>
<tr>
<td style="width: 40%;"><b>【是否註冊】</b></td>
<td><?php if($row[0]!=null){echo'已登記';}else{echo'未登記';}?></td>
</tr>
<tr>
<td style="width: 40%;"><b>【註冊編號】</b></td>
<td><?php if($row[0]!=null){echo $row[0];};?></td>
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
<input id="copy" class="mdl-textfield__input" value="<?php echo $ip; ?>" readonly style="width:100%" onClick="copyUrl2()"/>
</div>
</b> 
</td>
</tr>
<?php if($row[0]!=null){?>
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
<?php }?>
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
<?php if($row[0]!=null){?>
<tr>
<td><b>【註冊日期】</b></td>
<td><?php echo $row[10];?></td>
</tr>
<?php }?>
</tbody>
</table>
</div>
<?php }?>
</div>
</main>